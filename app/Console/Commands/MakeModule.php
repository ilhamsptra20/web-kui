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
                ['name' => 'name', 'type' => 'string', 'rules' => 'required'],
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

        foreach ($fields as $index => $field) {
            if (! is_array($field) || ! isset($field['name'], $field['type'])) {
                $this->error("Field definition at index {$index} must contain at least name and type.");

                return [];
            }

            if (! preg_match('/^[a-z][a-z0-9_]*$/', $field['name'])) {
                $this->error("Invalid field name [{$field['name']}] in schema.");

                return [];
            }

            if (! preg_match('/^[a-z][a-z0-9_]*$/', $field['type'])) {
                $this->error("Invalid field type [{$field['type']}] in schema.");

                return [];
            }

            if (isset($field['relation']) && ! preg_match('/^[a-z][a-z0-9_]*$/', $field['relation'])) {
                $this->error("Invalid relation name [{$field['relation']}] in schema.");

                return [];
            }
        }

        return $fields;
    }

    private function generateFolders(): void
    {
        $paths = [
            "app/Http/Requests",
            "routes/modules",
            "resources/views/modules/{$this->singular}"
        ];

        foreach ($paths as $path) {
            File::ensureDirectoryExists(base_path($path));
        }
    }

    private function generateMigration(): void
    {
        $lines = "";
        foreach ($this->fields as $f) {
            $type = $f['type'];
            $name = $f['name'];

            if ($type === 'image') {
                $lines .= "            \$table->string('{$name}')->nullable();\n";
                continue;
            }

            if ($name === 'user_id') {
                $lines .= "            \$table->foreignId('user_id')->nullable();\n";
                continue;
            }

            if (isset($f['relation']) && $type === 'uuid') {
                $lines .= "            \$table->foreignUuid('{$name}')->nullable();\n";
                continue;
            }

            $line = "\$table->{$type}('{$name}')";
            if ($type === 'string' && isset($f['length'])) {
                $line = "\$table->string('{$name}', {$f['length']})";
            }
            
            $lines .= "            {$line}->nullable();\n";
        }

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
{$lines}            \$table->timestamps();
        });
    }

    public function down(): void 
    { 
        Schema::dropIfExists('{$this->plural}'); 
    }
};
PHP;
        File::put(database_path("migrations/".date('Y_m_d_His')."_create_{$this->plural}_table.php"), $content);
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

        $fillable = collect($this->fields)->map(fn($f) => "'{$f['name']}'")->implode(', ');
        $relations = "";
        $casts = collect($this->fields)
            ->map(function (array $field): ?string {
                return match ($field['type']) {
                    'boolean' => "'{$field['name']}' => 'boolean'",
                    'datetime' => "'{$field['name']}' => 'datetime'",
                    'integer' => "'{$field['name']}' => 'integer'",
                    default => null,
                };
            })
            ->filter()
            ->implode(",\n            ");

        $traits = [];
        $imports = [];

        if ($hasSlug) {
            $traits[] = "HasSlug";
            $imports[] = "use Spatie\Sluggable\HasSlug;";
            $imports[] = "use Spatie\Sluggable\SlugOptions;";
        }

        if ($hasTranslations) {
            $traits[] = "HasTranslation";
            $imports[] = "use App\Traits\HasTranslation;";
        }

        $traitString = $traits !== [] ? 'use ' . implode(', ', $traits) . ';' : '';
        $importString = implode("\n", $imports);
        $slugMethod = "";
        $castsMethod = $casts !== ''
            ? "\n    protected function casts(): array\n    {\n        return [\n            {$casts},\n        ];\n    }\n"
            : "";

        if ($hasSlug) {
            $sourceField = collect($this->fields)
                ->first(function (array $field): bool {
                    return ! isset($field['relation'])
                        && ! in_array($field['name'], ['slug', 'user_id'], true)
                        && ($field['type'] ?? null) !== 'image';
                })['name'] ?? $this->fields[0]['name'];

            $slugMethod = "\n    public function getSlugOptions(): SlugOptions\n    {\n        return SlugOptions::create()\n            ->generateSlugsFrom('{$sourceField}')\n            ->saveSlugsTo('slug');\n    }\n";
        }

        foreach ($this->fields as $f) {
            if (isset($f['relation'])) {
                $method = ($f['name'] === 'user_id') ? 'user' : Str::camel($f['relation']);
                $model = ($f['name'] === 'user_id') ? 'User' : ucfirst(Str::camel($f['relation']));
                $relations .= "\n    public function {$method}()\n    {\n        return \$this->belongsTo({$model}::class, '{$f['name']}');\n    }\n";
            }
        }

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
        foreach (['Store', 'Update'] as $t) {
            $rules = "";
            foreach ($this->fields as $f) {
                if (in_array($f['name'], ['slug', 'user_id'])) continue;

                $rule = $f['rules'] ?? 'required';
                if ($f['type'] === 'image' && $t === 'Update') {
                    $rule = str_replace('required', 'nullable', $rule);
                }
                $rules .= "            '{$f['name']}' => '{$rule}',\n";
            }
            $content = "<?php\n\nnamespace App\Http\Requests;\n\nuse Illuminate\Foundation\Http\FormRequest;\n\nclass {$t}{$this->moduleName}Request extends FormRequest \n{\n    public function authorize() { return true; }\n    public function rules() \n    {\n        return [\n{$rules}        ];\n    }\n}";
            File::put(app_path("Http/Requests/{$t}{$this->moduleName}Request.php"), $content);
        }
    }

    private function generateController(): void
{
    $relationLoad = "";
    $relationVars = [];
    $uploadLogic = "";
    $hasUserId = collect($this->fields)->contains('name', 'user_id');

    foreach ($this->fields as $field) {
        if (isset($field['relation']) && $field['name'] !== 'user_id') {
            $model = ucfirst(Str::camel($field['relation']));
            $var   = Str::plural(Str::camel($field['relation']));
            $relationLoad .= "        \${$var} = \\App\\Models\\{$model}::query()->latest()->get();\n";
            $relationVars[] = "'{$var}'";
        }

        if ($field['type'] === 'image') {
            $uploadLogic .= "                if(\$request->hasFile('{$field['name']}')){\n                    \$data['{$field['name']}'] = \$request->file('{$field['name']}')->store('modules/{$this->plural}','public');\n                }\n";
        }
    }

    // Refactored compact logic into 1-line
    $relationCompactCreate = count($relationVars) ? ", compact(" . implode(',', $relationVars) . ")" : "";
    $relationCompactEdit = count($relationVars) ? ", compact('{$this->singular}'," . implode(',', $relationVars) . ")" : ", compact('{$this->singular}')";
    
    $authImport = $hasUserId ? "use Illuminate\Support\Facades\Auth;" : "";
    $authLogic  = $hasUserId ? "                \$data['user_id'] = Auth::id();" : "";

    $dt = $this->option('datatable') ? "    public function list()\n    {\n        return datatables()->of({$this->moduleName}::query())->addIndexColumn()->addColumn('action', fn(\$row)=>view('modules.{$this->singular}.action',compact('row'))->render())->rawColumns(['action'])->toJson();\n    }\n" : "";

    $content = <<<PHP
<?php

namespace App\Http\Controllers;

use App\Models\\{$this->moduleName};
use App\Http\Requests\Store{$this->moduleName}Request;
use App\Http\Requests\Update{$this->moduleName}Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
{$authImport}

class {$this->moduleName}Controller extends Controller
{
    public function index()
    {
        return view('modules.{$this->singular}.index');
    }

{$dt}
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
{$authLogic}
{$uploadLogic}
            {$this->moduleName}::create(\$data);
            DB::commit();
            return redirect()->route('{$this->plural}.index')->with('success','Data created');
        } catch(\Throwable \$e) {
            DB::rollBack();
            Log::error('{$this->moduleName} store error',['message'=>\$e->getMessage(),'data'=>\$request->all()]);
            return back()->withInput()->with('error','Failed create data');
        }
    }

    public function edit(\$id)
    {
        try {
            \${$this->singular} = {$this->moduleName}::findOrFail(\$id);
{$relationLoad}
            return view('modules.{$this->singular}.form'{$relationCompactEdit});
        } catch(\Throwable \$e) {
            Log::warning('{$this->moduleName} edit error',['id'=>\$id]);
            return redirect()->route('{$this->plural}.index')->with('error','Data not found');
        }
    }

    public function update(Update{$this->moduleName}Request \$request, \$id)
    {
        DB::beginTransaction();
        try {
            \$data = \$request->validated();
{$authLogic}
{$uploadLogic}
            \${$this->singular} = {$this->moduleName}::findOrFail(\$id);
            \${$this->singular}->update(\$data);
            DB::commit();
            return redirect()->route('{$this->plural}.index')->with('success','Data updated');
        } catch(\Throwable \$e) {
            DB::rollBack();
            Log::error('{$this->moduleName} update error',['id'=>\$id,'message'=>\$e->getMessage()]);
            return back()->withInput()->with('error','Update failed');
        }
    }

    public function destroy(\$id)
    {
        DB::beginTransaction();
        try {
            \${$this->singular} = {$this->moduleName}::findOrFail(\$id);
            \${$this->singular}->delete();
            DB::commit();
            return back()->with('success','Data deleted');
        } catch(\Throwable \$e) {
            DB::rollBack();
            Log::error('{$this->moduleName} delete error',['id'=>\$id]);
            return back()->with('error','Delete failed');
        }
    }
}
PHP;

    File::put(app_path("Http/Controllers/{$this->moduleName}Controller.php"), $content);
}

    private function generateRoutes(): void
    {

        $dtRoute = "";

        if($this->option('datatable')){
        $dtRoute = "Route::get('{$this->plural}/list',[{$this->moduleName}Controller::class,'list'])->name('{$this->plural}.list');";
        }

$content = <<<PHP
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\\{$this->moduleName}Controller;

{$dtRoute}

Route::resource('{$this->plural}',{$this->moduleName}Controller::class);
PHP;

        File::put(
        base_path("routes/modules/{$this->singular}.php"),
        $content
        );

        $web = base_path('routes/web.php');

        $line = "require __DIR__.'/modules/{$this->singular}.php';";

        if(!Str::contains(File::get($web),$line)){
        File::append($web,"\n".$line);
        }
    }

private function generateViews(): void
{
    $path = "resources/views/modules/{$this->singular}";
    $hasImage = collect($this->fields)->contains('type', 'image');
    $enctype = $hasImage ? 'enctype="multipart/form-data"' : '';

    $fieldsCollection = collect($this->fields);
    $displayField = $fieldsCollection->firstWhere('name', 'name');

    if (!$displayField) {
        $displayField = $fieldsCollection->first(function ($f) {
            return $f['type'] !== 'image' && !Str::endsWith($f['name'], '_id');
        });
    }

    $displayField     = $displayField ?? $this->fields[0];
    $displayFieldName = $displayField['name'];
    $displayLabel     = Str::title(str_replace('_', ' ', $displayFieldName));

    // Action View
    File::put(base_path("{$path}/action.blade.php"),
        "<div class=\"btn-group\">\n\t<a href=\"{{ route('{$this->plural}.edit', \$row->id) }}\" class=\"btn btn-sm btn-primary\">\n\t\t<i class=\"feather icon-edit\"></i>\n\t</a>\n\t<button type=\"button\" class=\"btn btn-sm btn-danger\" onclick=\"handleDelete('{{ route('{$this->plural}.destroy', \$row->id) }}')\">\n\t\t<i class=\"feather icon-trash\"></i>\n\t</button>\n</div>"
    );

    // Index View
    $dt = $this->option('datatable')
        ? "<x-table.datatable-script id='{$this->singular}-table' :url=\"route('{$this->plural}.list')\" :columns=\"[['data'=>'DT_RowIndex'],['data'=>'{$displayFieldName}'],['data'=>'action']]\" :order=\"[1, 'asc']\" />"
        : "";

    $index = "@extends('layouts.app')\n@section('title', 'Daftar {$this->moduleName}')\n\n@section('content')\n<div class='card'>\n    <div class='card-header'>\n        <h4 class='card-title'>{$this->moduleName}</h4>\n        <a href='{{ route('{$this->plural}.create') }}' class='btn btn-primary'>Add New</a>\n    </div>\n    <div class='card-body'>\n        <div class='table-responsive'>\n            <table class='table' id='{$this->singular}-table'>\n                <thead>\n                    <tr>\n                        <th>No</th>\n                        <th>{$displayLabel}</th>\n                        <th>Action</th>\n                    </tr>\n                </thead>\n            </table>\n        </div>\n    </div>\n</div>\n{$dt}\n@endsection";
    File::put(base_path("{$path}/index.blade.php"), $index);

    // Form View — fields
    $fieldsHtml = "";
    foreach ($this->fields as $f) {
        if (in_array($f['name'], ['slug', 'user_id'])) continue;

        $label      = Str::title(str_replace('_', ' ', $f['name']));
        $style      = $f['style'] ?? 'default';
        $isRequired = isset($f['rules']) && Str::contains($f['rules'], 'required');
        $reqProp    = $isRequired ? ' required' : '';

        if (isset($f['relation'])) {
            $vName        = Str::plural(Str::camel($f['relation']));
            $fieldsHtml  .= "        <x-form.select name='{$f['name']}' label='{$label}'{$reqProp}>\n"
                          . "            <option value='' selected>Select {$label}</option>\n"
                          . "            @foreach(\${$vName} as \$item)\n"
                          . "                <option value='{{ \$item->id }}' {{ (old('{$f['name']}', \${$this->singular}->{$f['name']} ?? '') == \$item->id) ? 'selected' : '' }}>{{ method_exists(\$item, 'trans') ? (\$item->trans('name') ?? \$item->trans('title') ?? \$item->id) : (\$item->name ?? \$item->title ?? \$item->id) }}</option>\n"
                          . "            @endforeach\n"
                          . "        </x-form.select>\n";
        } elseif ($f['type'] === 'image') {
            $fieldsHtml .= "        <x-form.photo-upload label='{$label}' name='{$f['name']}' :value=\"\${$this->singular}->{$f['name']} ?? null\"{$reqProp} />\n";
        } else {
            $fieldsHtml .= match($style) {
                'datepicker' => "        <x-form.datepicker name='{$f['name']}' label='{$label}' :value=\"\${$this->singular}->{$f['name']} ?? ''\"{$reqProp} />\n",
                'switch'     => "        <x-form.switch name='{$f['name']}' label='{$label}' :checked=\"\${$this->singular}->{$f['name']} ?? false\"{$reqProp} />\n",
                'textarea'   => "        <x-form.textarea name='{$f['name']}' label='{$label}'{$reqProp}>{{ \${$this->singular}->{$f['name']} ?? '' }}</x-form.textarea>\n",
                'radio'      => (function() use ($f, $label) {
                                    $options = $this->extractInOptions($f['rules'] ?? '');

                                    return "        <label class='form-label'>{$label}</label>\n"
                                        . "        <div class='d-flex gap-3'>\n"
                                        . "            @foreach(" . json_encode($options) . " as \$opt)\n"
                                        . "                <div class='form-check'>\n"
                                        . "                    <input class='form-check-input' type='radio' name='{$f['name']}' value='{{ \$opt }}'\n"
                                        . "                        {{ old('{$f['name']}', \${$this->singular}->{$f['name']} ?? '') == \$opt ? 'checked' : '' }}>\n"
                                        . "                    <label class='form-check-label'>{{ ucfirst(\$opt) }}</label>\n"
                                        . "                </div>\n"
                                        . "            @endforeach\n"
                                        . "        </div>\n";
                                })(),
                default      => "        <x-form.input name='{$f['name']}' label='{$label}' :value=\"\${$this->singular}->{$f['name']} ?? ''\"{$reqProp} floating divider />\n",
            };
        }
    }

    // SweetAlert untuk server error + Bootstrap client-side validation
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
    form.addEventListener('submit', function(e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            form.classList.add('was-validated');
            Swal.fire({
                icon: 'warning',
                title: 'Form Tidak Lengkap',
                text: 'Harap isi semua field yang wajib diisi.',
                confirmButtonColor: '#0d6efd',
                confirmButtonText: 'Oke, saya perbaiki'
            });
        } else {
            form.classList.add('was-validated');
        }
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
          . "        <form action=\"{{ \$isEdit ? route('{$this->plural}.update', \${$this->singular}->id) : route('{$this->plural}.store') }}\" method='POST' {$enctype} novalidate>\n"
          . "            @csrf\n"
          . "            @if(\$isEdit) @method('PUT') @endif\n\n"
          . $fieldsHtml
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
}

private function extractInOptions(string $rules): array
{
    preg_match('/in:([^|]+)/', $rules, $matches);

    if (!isset($matches[1])) {
        return [];
    }

    return array_map('trim', explode(',', $matches[1]));
}
}
