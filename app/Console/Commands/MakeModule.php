<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeModule extends Command
{
    protected $signature = 'make:module {name} {--datatable} {--json=}';

    protected $description = 'Simple Laravel Module Scaffolder';

    protected string $moduleName;

    protected string $singular;

    protected string $plural;

    protected array $fields = [];

    public function handle(): int
    {
        $this->moduleName = Str::studly($this->argument('name'));

        if (! preg_match('/^[A-Z][A-Za-z0-9]*$/', $this->moduleName)) {
            $this->error('Module name must be a valid StudlyCase class name.');

            return 1;
        }

        $this->singular = Str::snake($this->moduleName);
        $this->plural = Str::plural($this->singular);

        if ($this->option('json')) {
            $this->fields = $this->loadFieldsFromJson((string) $this->option('json'));

            if ($this->fields === []) {
                return 1;
            }
        } else {
            $this->fields = [
                ['name' => 'name', 'type' => 'string', 'rules' => 'required|string|max:255'],
            ];
        }

        $this->info("Building module {$this->moduleName}");

        $this->generateFolders();
        $this->generateMigration();
        $this->generateModel();
        $this->generateRequests();
        $this->generateController();
        $this->generateRoutes();
        $this->generateViews();

        $this->info("Module {$this->moduleName} created");

        return 0;
    }

    private function loadFieldsFromJson(string $jsonFile): array
    {
        $file = basename($jsonFile);

        if ($file !== $jsonFile) {
            $this->error('JSON path must reference a file inside the _dataApp directory only.');

            return [];
        }

        $path = base_path('_dataApp/' . $file);

        if (! File::exists($path)) {
            $this->error("JSON not found : {$path}");

            return [];
        }

        try {
            $fields = json_decode(File::get($path), true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $exception) {
            $this->error("Invalid JSON schema: {$exception->getMessage()}");

            return [];
        }

        if (! is_array($fields) || ! array_is_list($fields)) {
            $this->error('JSON schema must be a list of field definitions.');

            return [];
        }

        $normalized = [];

        foreach ($fields as $index => $field) {
            if (! is_array($field) || ! isset($field['name'], $field['type'])) {
                $this->error("Field definition at index {$index} must contain at least name and type.");

                return [];
            }

            $field['type'] = Str::lower((string) $field['type']);
            $field['style'] = isset($field['style']) ? Str::lower((string) $field['style']) : null;

            if (! preg_match('/^[a-z][a-z0-9_]*$/', (string) $field['name'])) {
                $this->error("Invalid field name [{$field['name']}] in schema.");

                return [];
            }

            if (! preg_match('/^[a-z][a-z0-9_]*$/', (string) $field['type'])) {
                $this->error("Invalid field type [{$field['type']}] in schema.");

                return [];
            }

            if (isset($field['relation']) && ! preg_match('/^[a-z][a-z0-9_]*$/', (string) $field['relation'])) {
                $this->error("Invalid relation name [{$field['relation']}] in schema.");

                return [];
            }

            $normalized[] = $field;
        }

        return $normalized;
    }

    private function generateFolders(): void
    {
        $paths = [
            'app/Http/Requests',
            'routes/modules',
            "resources/views/modules/{$this->singular}",
        ];

        foreach ($paths as $path) {
            File::ensureDirectoryExists(base_path($path));
        }
    }

    private function generateMigration(): void
    {
        $lines = collect($this->fields)
            ->map(fn (array $field): string => '            ' . $this->buildMigrationLine($field))
            ->implode("\n");

        $content = <<<PHP
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('{$this->plural}', function (Blueprint \$table) {
            \$table->uuid('id')->primary();
{$lines}
            \$table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('{$this->plural}');
    }
};
PHP;

        File::put(
            database_path('migrations/' . date('Y_m_d_His') . "_create_{$this->plural}_table.php"),
            $content
        );
    }

    private function buildMigrationLine(array $field): string
    {
        $name = $field['name'];
        $type = $field['type'];

        if ($this->usesCkeditor($field)) {
            return "\$table->longText('{$name}')->nullable();";
        }

        if ($this->isImageField($field)) {
            return "\$table->string('{$name}')->nullable();";
        }

        if ($name === 'user_id') {
            return "\$table->foreignId('user_id')->nullable();";
        }

        if (isset($field['relation']) && $this->isUuidLike($type)) {
            return "\$table->foreignUuid('{$name}')->nullable();";
        }

        if (isset($field['relation']) && Str::endsWith($name, '_id')) {
            return "\$table->foreignId('{$name}')->nullable();";
        }

        $method = $this->resolveMigrationMethod($type);

        if ($method === 'string' && isset($field['length'])) {
            return "\$table->string('{$name}', {$field['length']})->nullable();";
        }

        if ($method === 'decimal') {
            $precision = $field['precision'] ?? 12;
            $scale = $field['scale'] ?? 2;

            return "\$table->decimal('{$name}', {$precision}, {$scale})->nullable();";
        }

        return "\$table->{$method}('{$name}')->nullable();";
    }

    private function resolveMigrationMethod(string $type): string
    {
        return match ($type) {
            'longtext' => 'longText',
            'mediumtext' => 'mediumText',
            'richtext' => 'longText',
            'datetime' => 'dateTime',
            'timestamp' => 'timestamp',
            'json' => 'json',
            default => $type,
        };
    }

    private function generateModel(): void
    {
        $hasSlug = collect($this->fields)->contains('name', 'slug');
        $hasTranslations = collect($this->fields)->contains(function (array $field): bool {
            return Str::endsWith($field['name'], ['_en', '_ar'])
                || (
                    Str::endsWith($field['name'], '_id')
                    && ($field['type'] ?? null) !== 'uuid'
                    && ! isset($field['relation'])
                );
        });

        $fillable = collect($this->fields)
            ->map(fn (array $field): string => "'{$field['name']}'")
            ->implode(', ');

        $casts = collect($this->fields)
            ->map(function (array $field): ?string {
                return match ($field['type']) {
                    'boolean' => "'{$field['name']}' => 'boolean'",
                    'datetime' => "'{$field['name']}' => 'datetime'",
                    'integer' => "'{$field['name']}' => 'integer'",
                    'decimal' => "'{$field['name']}' => 'decimal:2'",
                    default => null,
                };
            })
            ->filter()
            ->implode(",\n            ");

        $traits = [];
        $imports = [];

        if ($hasSlug) {
            $traits[] = 'HasSlug';
            $imports[] = 'use Spatie\Sluggable\HasSlug;';
            $imports[] = 'use Spatie\Sluggable\SlugOptions;';
        }

        if ($hasTranslations) {
            $traits[] = 'HasTranslation';
            $imports[] = 'use App\Traits\HasTranslation;';
        }

        $traitString = $traits !== [] ? 'use ' . implode(', ', $traits) . ';' : '';
        $importString = implode("\n", $imports);
        $castsMethod = $casts !== ''
            ? "\n    protected function casts(): array\n    {\n        return [\n            {$casts},\n        ];\n    }\n"
            : '';

        $slugMethod = '';

        if ($hasSlug) {
            $sourceField = collect($this->fields)
                ->first(function (array $field): bool {
                    return ! isset($field['relation'])
                        && ! in_array($field['name'], ['slug', 'user_id'], true)
                        && ! $this->isImageField($field);
                })['name'] ?? $this->fields[0]['name'];

            $slugMethod = "\n    public function getSlugOptions(): SlugOptions\n    {\n        return SlugOptions::create()\n            ->generateSlugsFrom('{$sourceField}')\n            ->saveSlugsTo('slug')\n            ->doNotGenerateSlugsOnUpdate();\n    }\n";
        }

        $relations = collect($this->fields)
            ->filter(fn (array $field): bool => isset($field['relation']))
            ->map(function (array $field): string {
                $method = $this->relationMethodName($field);
                $model = $this->relationModelName($field);

                return "\n    public function {$method}()\n    {\n        return \$this->belongsTo({$model}::class, '{$field['name']}');\n    }\n";
            })
            ->implode('');

        $content = <<<PHP
<?php

namespace App\Models;

{$importString}

class {$this->moduleName} extends BaseUuidModel
{
    {$traitString}

    protected \$fillable = [{$fillable}];
{$castsMethod}{$slugMethod}{$relations}
}
PHP;

        File::put(app_path("Models/{$this->moduleName}.php"), $content);
    }

    private function generateRequests(): void
    {
        $booleanFields = collect($this->fields)
            ->filter(fn (array $field): bool => $field['type'] === 'boolean')
            ->pluck('name')
            ->all();

        foreach (['Store', 'Update'] as $verb) {
            $rules = collect($this->fields)
                ->reject(fn (array $field): bool => in_array($field['name'], ['slug', 'user_id'], true))
                ->map(function (array $field) use ($verb): string {
                    $rule = $field['rules'] ?? $this->defaultRulesForField($field);

                    if ($this->isImageField($field) && $verb === 'Update') {
                        $rule = str_replace('required', 'nullable', $rule);
                    }

                    return "            '{$field['name']}' => '{$rule}',";
                })
                ->implode("\n");

            $prepareForValidation = '';

            if ($booleanFields !== []) {
                $prepareLines = collect($booleanFields)
                    ->map(fn (string $field): string => "            '{$field}' => \$this->boolean('{$field}'),")
                    ->implode("\n");

                $prepareForValidation = "\n    protected function prepareForValidation(): void\n    {\n        \$this->merge([\n{$prepareLines}\n        ]);\n    }\n";
            }

            $content = <<<PHP
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class {$verb}{$this->moduleName}Request extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
{$rules}
        ];
    }{$prepareForValidation}
}
PHP;

            File::put(app_path("Http/Requests/{$verb}{$this->moduleName}Request.php"), $content);
        }
    }

    private function generateController(): void
    {
        $displayField = $this->resolveDisplayField();
        $displayFieldName = $displayField['name'];

        $relationLoad = collect($this->fields)
            ->filter(fn (array $field): bool => isset($field['relation']) && $field['name'] !== 'user_id')
            ->map(function (array $field): string {
                $model = $this->relationModelName($field);
                $variable = Str::plural($this->relationMethodName($field));

                return "        \${$variable} = \\App\\Models\\{$model}::query()->latest()->get();";
            })
            ->implode("\n");

        $relationVars = collect($this->fields)
            ->filter(fn (array $field): bool => isset($field['relation']) && $field['name'] !== 'user_id')
            ->map(fn (array $field): string => "'" . Str::plural($this->relationMethodName($field)) . "'")
            ->all();

        $storeUploadLogic = $this->buildStoreUploadLogic();
        $updateUploadLogic = $this->buildUpdateUploadLogic();
        $destroyUploadLogic = $this->buildDestroyUploadLogic();
        $richTextSanitizeLogic = $this->buildRichTextSanitizeLogic();
        $hasImageFields = collect($this->fields)->contains(fn (array $field): bool => $this->isImageField($field));
        $hasUserId = collect($this->fields)->contains('name', 'user_id');
        $hasRichTextFields = collect($this->fields)->contains(fn (array $field): bool => $this->usesCkeditor($field));

        $authImport = $hasUserId ? "use Illuminate\Support\Facades\Auth;\n" : '';
        $storageImport = $hasImageFields ? "use Illuminate\Support\Facades\Storage;\n" : '';
        $richTextImport = $hasRichTextFields ? "use App\Support\RichText\RichTextSanitizer;\n" : '';
        $authLogic = $hasUserId ? "            \$data['user_id'] = Auth::id();\n" : '';

        $indexBody = $this->option('datatable')
            ? "        return view('modules.{$this->singular}.index');"
            : "        \${$this->plural} = {$this->moduleName}::query()->latest()->paginate(15);\n\n        return view('modules.{$this->singular}.index', compact('{$this->plural}'));";

        $relationCompactCreate = $relationVars !== [] ? ', compact(' . implode(', ', $relationVars) . ')' : '';
        $relationCompactEdit = $relationVars !== []
            ? ", compact('{$this->singular}', " . implode(', ', $relationVars) . ')'
            : ", compact('{$this->singular}')";
        $relationCompactShow = $relationVars !== []
            ? ", compact('{$this->singular}', " . implode(', ', $relationVars) . ')'
            : ", compact('{$this->singular}')";

        $datatableMethod = '';

        if ($this->option('datatable')) {
            $datatableDisplayColumn = $this->buildDatatableDisplayColumn($displayFieldName);
            $datatableMethod = <<<PHP

    public function list()
    {
        return datatables()
            ->of({$this->moduleName}::query())
            ->addIndexColumn()
{$datatableDisplayColumn}
            ->addColumn('action', fn (\$row) => view('modules.{$this->singular}.action', compact('row'))->render())
            ->rawColumns(['action'])
            ->toJson();
    }
PHP;
        }

        $content = <<<PHP
<?php

namespace App\Http\Controllers;

use App\Models\\{$this->moduleName};
use App\Http\Requests\Store{$this->moduleName}Request;
use App\Http\Requests\Update{$this->moduleName}Request;
use Illuminate\Support\Facades\DB;
{$authImport}{$storageImport}{$richTextImport}
class {$this->moduleName}Controller extends Controller
{
    public function index()
    {
{$indexBody}
    }{$datatableMethod}

    public function create()
    {
{$relationLoad}
        return view('modules.{$this->singular}.form'{$relationCompactCreate});
    }

    public function store(Store{$this->moduleName}Request \$request)
    {
        DB::beginTransaction();

        try {
            \$data = \$request->validated();
{$richTextSanitizeLogic}{$authLogic}{$storeUploadLogic}
            \${$this->singular} = {$this->moduleName}::create(\$data);

            DB::commit();

            return redirect()->route('{$this->plural}.show', \${$this->singular})->with('success', 'Data created');
        } catch (\Throwable \$e) {
            DB::rollBack();
            report(\$e);

            return back()->withInput()->with('error', 'Failed create data');
        }
    }

    public function show({$this->moduleName} \${$this->singular})
    {
{$relationLoad}
        return view('modules.{$this->singular}.show'{$relationCompactShow});
    }

    public function edit({$this->moduleName} \${$this->singular})
    {
{$relationLoad}
        return view('modules.{$this->singular}.form'{$relationCompactEdit});
    }

    public function update(Update{$this->moduleName}Request \$request, {$this->moduleName} \${$this->singular})
    {
        DB::beginTransaction();

        try {
            \$data = \$request->validated();
{$richTextSanitizeLogic}{$authLogic}{$updateUploadLogic}
            \${$this->singular}->update(\$data);

            DB::commit();

            return redirect()->route('{$this->plural}.show', \${$this->singular})->with('success', 'Data updated');
        } catch (\Throwable \$e) {
            DB::rollBack();
            report(\$e);

            return back()->withInput()->with('error', 'Update failed');
        }
    }

    public function destroy({$this->moduleName} \${$this->singular})
    {
        DB::beginTransaction();

        try {
{$destroyUploadLogic}
            \${$this->singular}->delete();

            DB::commit();

            return redirect()->route('{$this->plural}.index')->with('success', 'Data deleted');
        } catch (\Throwable \$e) {
            DB::rollBack();
            report(\$e);

            return back()->with('error', 'Delete failed');
        }
    }
}
PHP;

        File::put(app_path("Http/Controllers/{$this->moduleName}Controller.php"), $content);
    }

    private function buildStoreUploadLogic(): string
    {
        return collect($this->fields)
            ->filter(fn (array $field): bool => $this->isImageField($field))
            ->map(function (array $field): string {
                return "            if (\$request->hasFile('{$field['name']}')) {\n                \$data['{$field['name']}'] = \$request->file('{$field['name']}')->store('modules/{$this->plural}', 'public');\n            }\n";
            })
            ->implode('');
    }

    private function buildUpdateUploadLogic(): string
    {
        return collect($this->fields)
            ->filter(fn (array $field): bool => $this->isImageField($field))
            ->map(function (array $field): string {
                return "            if (\$request->hasFile('{$field['name']}')) {\n                if (\${$this->singular}->{$field['name']}) {\n                    Storage::disk('public')->delete(\${$this->singular}->{$field['name']});\n                }\n\n                \$data['{$field['name']}'] = \$request->file('{$field['name']}')->store('modules/{$this->plural}', 'public');\n            }\n";
            })
            ->implode('');
    }

    private function buildDestroyUploadLogic(): string
    {
        return collect($this->fields)
            ->filter(fn (array $field): bool => $this->isImageField($field))
            ->map(function (array $field): string {
                return "            if (\${$this->singular}->{$field['name']}) {\n                Storage::disk('public')->delete(\${$this->singular}->{$field['name']});\n            }\n";
            })
            ->implode('');
    }

    private function generateRoutes(): void
    {
        $datatableRoute = $this->option('datatable')
            ? "Route::get('{$this->plural}/list', [{$this->moduleName}Controller::class, 'list'])->name('{$this->plural}.list');\n"
            : '';

        $content = <<<PHP
<?php

use App\Http\Controllers\\{$this->moduleName}Controller;
use Illuminate\Support\Facades\Route;

{$datatableRoute}Route::resource('{$this->plural}', {$this->moduleName}Controller::class);
PHP;

        File::put(base_path("routes/modules/{$this->singular}.php"), $content);

        $line = "require __DIR__.'/modules/{$this->singular}.php';";

        $this->ensureWebAuthGroupContains([$line]);

        if (collect($this->fields)->contains(fn (array $field): bool => $this->usesCkeditor($field))) {
            $this->ensureWebImport('App\Http\Controllers\EditorImageController');
            $this->ensureWebAuthGroupContains([
                "Route::post('/editor-images', [EditorImageController::class, 'store'])->name('editor-images.store');",
            ]);
        }
    }

    private function generateViews(): void
    {
        $path = "resources/views/modules/{$this->singular}";
        $hasImage = collect($this->fields)->contains(fn (array $field): bool => $this->isImageField($field));
        $hasRichText = collect($this->fields)->contains(fn (array $field): bool => $this->usesCkeditor($field));
        $enctype = $hasImage ? 'enctype="multipart/form-data"' : '';

        $displayField = $this->resolveDisplayField();
        $displayFieldName = $displayField['name'];
        $displayLabel = Str::title(str_replace('_', ' ', $displayFieldName));

        File::put(
            base_path("{$path}/action.blade.php"),
            "<div class=\"btn-group\">\n\t<a href=\"{{ route('{$this->plural}.show', \$row->id) }}\" class=\"btn btn-sm btn-info\"><i class=\"feather icon-eye\"></i></a>\n\t<a href=\"{{ route('{$this->plural}.edit', \$row->id) }}\" class=\"btn btn-sm btn-primary\"><i class=\"feather icon-edit\"></i></a>\n\t<button type=\"button\" class=\"btn btn-sm btn-danger\" onclick=\"handleDelete('{{ route('{$this->plural}.destroy', \$row->id) }}')\"><i class=\"feather icon-trash\"></i></button>\n</div>"
        );

        $indexContent = $this->buildIndexView($displayFieldName, $displayLabel);
        File::put(base_path("{$path}/index.blade.php"), $indexContent);

        $fieldsPartial = "@php \$showMode = \$showMode ?? false; @endphp\n\n"
            . collect($this->fields)
            ->reject(fn (array $field): bool => in_array($field['name'], ['slug', 'user_id'], true))
            ->map(fn (array $field): string => $this->buildSharedField($field))
            ->implode('');

        File::put(base_path("{$path}/fields.blade.php"), $fieldsPartial);

        $validationScript = <<<'BLADE'

@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', () => {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#dc3545'
        });
    });
</script>
@endif

<script>
(() => {
    const form = document.querySelector('form[novalidate]');
    if (!form) return;

    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            form.classList.add('was-validated');

            Swal.fire({
                icon: 'warning',
                title: 'Form Tidak Lengkap',
                text: 'Harap isi semua field yang wajib diisi.',
                confirmButtonColor: '#0d6efd',
                confirmButtonText: 'Oke, saya perbaiki'
            });

            return;
        }

        form.classList.add('was-validated');
    });
})();
</script>
BLADE;

        $form = "@php \$isEdit = isset(\${$this->singular}); @endphp\n"
            . "@extends('layouts.app')\n"
            . "@section('title', (\$isEdit ? 'Edit' : 'Tambah') . ' {$this->moduleName}')\n\n"
            . "@section('content')\n"
            . "<div class='card'>\n"
            . "    <div class='card-body'>\n"
            . "        <form action=\"{{ \$isEdit ? route('{$this->plural}.update', \${$this->singular}) : route('{$this->plural}.store') }}\" method='POST' {$enctype} novalidate>\n"
            . "            @csrf\n"
            . "            @if(\$isEdit) @method('PUT') @endif\n\n"
            . "            @include('modules.{$this->singular}.fields', ['showMode' => false])\n"
            . "\n            <div class='mt-3'>\n"
            . "                <button type='submit' class='btn btn-primary'>Save Data</button>\n"
            . "                <a href='{{ route('{$this->plural}.index') }}' class='btn btn-outline-secondary'>Back</a>\n"
            . "            </div>\n"
            . "        </form>\n"
            . "    </div>\n"
            . "</div>\n"
            . $validationScript
            . "\n@endsection";

        File::put(base_path("{$path}/form.blade.php"), $form);

        $showContent = "@extends('layouts.app')\n"
            . "@section('title', 'Detail {$this->moduleName}')\n\n"
            . "@section('content')\n"
            . "<div class='card'>\n"
            . "    <div class='card-header d-flex justify-content-between align-items-center'>\n"
            . "        <h4 class='card-title mb-0'>Detail {$this->moduleName}</h4>\n"
            . "        <div class='d-flex'>\n"
            . "            <a href='{{ route('{$this->plural}.edit', \${$this->singular}) }}' class='btn btn-primary mr-1'>Edit</a>\n"
            . "            <a href='{{ route('{$this->plural}.index') }}' class='btn btn-outline-secondary'>Back</a>\n"
            . "        </div>\n"
            . "    </div>\n"
            . "    <div class='card-body'>\n"
            . "        @include('modules.{$this->singular}.fields', ['showMode' => true])\n"
            . "\n    </div>\n"
            . "</div>\n"
            . "@endsection\n";

        File::put(base_path("{$path}/show.blade.php"), $showContent);
    }

    private function buildIndexView(string $displayFieldName, string $displayLabel): string
    {
        if ($this->option('datatable')) {
            $datatableScript = "<x-table.datatable-script id='{$this->singular}-table' :url=\"route('{$this->plural}.list')\" :columns=\"[['data'=>'DT_RowIndex'],['data'=>'{$displayFieldName}'],['data'=>'action']]\" :order=\"[1, 'asc']\" />";

            return "@extends('layouts.app')\n@section('title', 'Daftar {$this->moduleName}')\n\n@section('content')\n<div class='card'>\n    <div class='card-header'>\n        <h4 class='card-title'>{$this->moduleName}</h4>\n        <a href='{{ route('{$this->plural}.create') }}' class='btn btn-primary'>Add New</a>\n    </div>\n    <div class='card-body'>\n        <div class='table-responsive'>\n            <table class='table' id='{$this->singular}-table'>\n                <thead>\n                    <tr>\n                        <th>No</th>\n                        <th>{$displayLabel}</th>\n                        <th>Action</th>\n                    </tr>\n                </thead>\n            </table>\n        </div>\n    </div>\n</div>\n{$datatableScript}\n@endsection";
        }

        $indexCell = $this->buildIndexCell($displayFieldName);

        return "@extends('layouts.app')\n@section('title', 'Daftar {$this->moduleName}')\n\n@section('content')\n<div class='card'>\n    <div class='card-header d-flex justify-content-between align-items-center'>\n        <h4 class='card-title mb-0'>{$this->moduleName}</h4>\n        <a href='{{ route('{$this->plural}.create') }}' class='btn btn-primary'>Add New</a>\n    </div>\n    <div class='card-body'>\n        <div class='table-responsive'>\n            <table class='table'>\n                <thead>\n                    <tr>\n                        <th>No</th>\n                        <th>{$displayLabel}</th>\n                        <th>Action</th>\n                    </tr>\n                </thead>\n                <tbody>\n                    @forelse(\${$this->plural} as \${$this->singular})\n                        <tr>\n                            <td>{{ \$loop->iteration + (\${$this->plural}->firstItem() - 1) }}</td>\n                            <td>{$indexCell}</td>\n                            <td>\n                                <div class='btn-group'>\n                                    <a href='{{ route('{$this->plural}.show', \${$this->singular}) }}' class='btn btn-sm btn-info'><i class='feather icon-eye'></i></a>\n                                    <a href='{{ route('{$this->plural}.edit', \${$this->singular}) }}' class='btn btn-sm btn-primary'><i class='feather icon-edit'></i></a>\n                                    <form action='{{ route('{$this->plural}.destroy', \${$this->singular}) }}' method='POST' onsubmit=\"return confirm('Delete this data?')\" class='d-inline'>\n                                        @csrf\n                                        @method('DELETE')\n                                        <button type='submit' class='btn btn-sm btn-danger'><i class='feather icon-trash'></i></button>\n                                    </form>\n                                </div>\n                            </td>\n                        </tr>\n                    @empty\n                        <tr><td colspan='3' class='text-center text-muted py-3'>No data available</td></tr>\n                    @endforelse\n                </tbody>\n            </table>\n        </div>\n\n        <div class='mt-2'>{{ \${$this->plural}->links() }}</div>\n    </div>\n</div>\n@endsection";
    }

    private function buildIndexCell(string $displayFieldName): string
    {
        $field = collect($this->fields)->firstWhere('name', $displayFieldName) ?? ['name' => $displayFieldName, 'type' => 'string'];

        if ($this->usesCkeditor($field) || ($field['style'] ?? null) === 'textarea') {
            return "{{ \\Illuminate\\Support\\Str::limit(strip_tags(\${$this->singular}->{$displayFieldName}), 80) }}";
        }

        if (($field['type'] ?? null) === 'boolean') {
            return "{{ \${$this->singular}->{$displayFieldName} ? 'Yes' : 'No' }}";
        }

        return "{{ \${$this->singular}->{$displayFieldName} }}";
    }

    private function buildSharedField(array $field): string
    {
        $label = Str::title(str_replace('_', ' ', $field['name']));
        $style = $field['style'] ?? 'default';
        $required = isset($field['rules']) && Str::contains($field['rules'], 'required') ? ' required' : '';

        if (isset($field['relation'])) {
            $variableName = Str::plural($this->relationMethodName($field));
            $displayExpression = $this->relationDisplayExpression('$item');

            return "        <x-form.select name='{$field['name']}' label='{$label}'{$required} :disabled=\"\$showMode\">\n"
                . "            <option value='' selected>Select {$label}</option>\n"
                . "            @foreach(\${$variableName} as \$item)\n"
                . "                <option value='{{ \$item->id }}' {{ (old('{$field['name']}', \${$this->singular}->{$field['name']} ?? '') == \$item->id) ? 'selected' : '' }}>{$displayExpression}</option>\n"
                . "            @endforeach\n"
                . "        </x-form.select>\n";
        }

        if ($this->isImageField($field)) {
            return "        <x-form.photo-upload label='{$label}' name='{$field['name']}' :value=\"\${$this->singular}->{$field['name']} ?? null\" :readonly=\"\$showMode\"{$required} />\n";
        }

        if ($this->usesCkeditor($field)) {
            return "        <x-form.ckeditor name='{$field['name']}' label='{$label}' :value=\"\${$this->singular}->{$field['name']} ?? ''\" :readonly=\"\$showMode\" :enable-images=\"! \$showMode\"{$required} />\n";
        }

        return match ($style) {
            'datepicker' => "        <x-form.datepicker name='{$field['name']}' label='{$label}' :value=\"\${$this->singular}->{$field['name']} ?? ''\" :readonly=\"\$showMode\" :disabled=\"\$showMode\"{$required} />\n",
            'switch' => "        <x-form.switch name='{$field['name']}' label='{$label}' :checked=\"old('{$field['name']}', \${$this->singular}->{$field['name']} ?? false)\" :disabled=\"\$showMode\"{$required} />\n",
            'textarea' => "        <x-form.textarea name='{$field['name']}' label='{$label}' :readonly=\"\$showMode\" :disabled=\"\$showMode\"{$required}>{{ \${$this->singular}->{$field['name']} ?? '' }}</x-form.textarea>\n",
            'radio' => $this->buildSharedRadioField($field, $label),
            default => $this->buildSharedInputField($field, $label, $required),
        };
    }

    private function buildSharedInputField(array $field, string $label, string $required): string
    {
        $inputType = match ($field['type']) {
            'integer', 'decimal' => 'number',
            'datetime' => 'datetime-local',
            default => 'text',
        };

        return "        <x-form.input name='{$field['name']}' type='{$inputType}' label='{$label}' :value=\"\${$this->singular}->{$field['name']} ?? ''\" :readonly=\"\$showMode\" :disabled=\"\$showMode\"{$required} floating divider />\n";
    }

    private function buildSharedRadioField(array $field, string $label): string
    {
        $options = $this->extractInOptions($field['rules'] ?? '');

        return "        <label class='form-label'>{$label}</label>\n"
            . "        <div class='d-flex gap-3 flex-wrap mb-2'>\n"
            . "            @foreach(" . var_export($options, true) . " as \$opt)\n"
            . "                <div class='form-check'>\n"
            . "                    <input class='form-check-input' type='radio' name='{$field['name']}' value='{{ \$opt }}' {{ old('{$field['name']}', \${$this->singular}->{$field['name']} ?? '') == \$opt ? 'checked' : '' }} @disabled(\$showMode)>\n"
            . "                    <label class='form-check-label'>{{ ucfirst(\$opt) }}</label>\n"
            . "                </div>\n"
            . "            @endforeach\n"
            . "        </div>\n";
    }

    private function resolveDisplayField(): array
    {
        $fieldsCollection = collect($this->fields);
        $displayField = $fieldsCollection->firstWhere('name', 'name');

        if (! $displayField) {
            $displayField = $fieldsCollection->first(function (array $field) {
                return ! $this->isImageField($field) && ! Str::endsWith($field['name'], '_id');
            });
        }

        return $displayField ?? $this->fields[0];
    }

    private function buildDatatableDisplayColumn(string $displayFieldName): string
    {
        $field = collect($this->fields)->firstWhere('name', $displayFieldName) ?? ['name' => $displayFieldName, 'type' => 'string'];

        if ($this->usesCkeditor($field) || ($field['style'] ?? null) === 'textarea') {
            return "            ->editColumn('{$displayFieldName}', fn (\$row) => \\Illuminate\\Support\\Str::limit(strip_tags(\$row->{$displayFieldName}), 80))\n";
        }

        return '';
    }

    private function buildRichTextSanitizeLogic(): string
    {
        $richTextFields = collect($this->fields)
            ->filter(fn (array $field): bool => $this->usesCkeditor($field))
            ->pluck('name')
            ->all();

        if ($richTextFields === []) {
            return '';
        }

        $lines = collect($richTextFields)
            ->map(fn (string $field): string => "            \$data['{$field}'] = \$sanitizer->sanitize(\$data['{$field}'] ?? null);")
            ->implode("\n");

        return "            \$sanitizer = app(RichTextSanitizer::class);\n{$lines}\n";
    }

    private function relationMethodName(array $field): string
    {
        return $field['name'] === 'user_id'
            ? 'user'
            : Str::camel($field['relation']);
    }

    private function relationModelName(array $field): string
    {
        return $field['name'] === 'user_id'
            ? 'User'
            : ucfirst(Str::camel($field['relation']));
    }

    private function relationDisplayExpression(string $variable): string
    {
        return "{{ {$variable} ? (method_exists({$variable}, 'trans') ? ({$variable}->trans('name') ?? {$variable}->trans('title') ?? {$variable}->id ?? '-') : ({$variable}->name ?? {$variable}->title ?? {$variable}->id ?? '-')) : '-' }}";
    }

    private function isImageField(array $field): bool
    {
        return ($field['type'] ?? null) === 'image';
    }

    private function usesCkeditor(array $field): bool
    {
        return ($field['type'] ?? null) === 'richtext'
            || ($field['style'] ?? null) === 'ckeditor';
    }

    private function isUuidLike(string $type): bool
    {
        return in_array($type, ['uuid', 'foreignuuid'], true);
    }

    private function defaultRulesForField(array $field): string
    {
        if ($this->usesCkeditor($field)) {
            return 'nullable|string';
        }

        return 'required';
    }

    private function extractInOptions(string $rules): array
    {
        preg_match('/in:([^|]+)/', $rules, $matches);

        if (! isset($matches[1])) {
            return [];
        }

        return array_map('trim', explode(',', $matches[1]));
    }

    private function ensureWebImport(string $import): void
    {
        $webPath = base_path('routes/web.php');
        $lines = preg_split('/\R/', File::get($webPath));
        $importLine = "use {$import};";

        if (in_array($importLine, $lines, true)) {
            return;
        }

        $lastUseIndex = null;

        foreach ($lines as $index => $line) {
            if (str_starts_with(trim($line), 'use ')) {
                $lastUseIndex = $index;
            }
        }

        if ($lastUseIndex !== null) {
            array_splice($lines, $lastUseIndex + 1, 0, [$importLine]);
        } else {
            array_splice($lines, 1, 0, ['', $importLine]);
        }

        File::put($webPath, implode(PHP_EOL, $lines) . PHP_EOL);
    }

    /**
     * @param  array<int, string>  $entries
     */
    private function ensureWebAuthGroupContains(array $entries): void
    {
        $webPath = base_path('routes/web.php');
        $lines = preg_split('/\R/', File::get($webPath));
        [$startIndex, $endIndex] = $this->findAuthGroupBounds($lines);

        if ($startIndex === null || $endIndex === null) {
            $newBlock = [
                '',
                "Route::middleware('auth')->group(function () {",
            ];

            foreach ($entries as $entry) {
                $newBlock[] = '    ' . $entry;
            }

            $newBlock[] = '});';

            $lines = array_merge($lines, $newBlock);
            File::put($webPath, implode(PHP_EOL, $lines) . PHP_EOL);

            return;
        }

        $body = implode(PHP_EOL, array_slice($lines, $startIndex + 1, $endIndex - $startIndex - 1));
        $insertions = [];

        foreach ($entries as $entry) {
            if (! str_contains($body, $entry)) {
                $insertions[] = '    ' . $entry;
            }
        }

        if ($insertions === []) {
            return;
        }

        array_splice($lines, $endIndex, 0, $insertions);
        File::put($webPath, implode(PHP_EOL, $lines) . PHP_EOL);
    }

    /**
     * @param  array<int, string>  $lines
     * @return array{0: int|null, 1: int|null}
     */
    private function findAuthGroupBounds(array $lines): array
    {
        $startIndex = null;
        $depth = 0;

        foreach ($lines as $index => $line) {
            $trimmed = trim($line);

            if ($startIndex === null) {
                if (! str_contains($trimmed, 'Route::middleware(') || ! str_contains($trimmed, "'auth'") || ! str_contains($trimmed, '->group(function')) {
                    continue;
                }

                $startIndex = $index;
                $depth = substr_count($line, '{') - substr_count($line, '}');

                if ($depth === 0) {
                    return [$startIndex, $index];
                }

                continue;
            }

            $depth += substr_count($line, '{') - substr_count($line, '}');

            if ($depth === 0) {
                return [$startIndex, $index];
            }
        }

        return [null, null];
    }
}
