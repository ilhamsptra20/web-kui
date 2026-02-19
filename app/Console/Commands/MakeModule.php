<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeModule extends Command
{
    protected $signature = 'make:module {name} {--datatable} {--json=}';
    protected $description = 'Professional Module Scaffolder with Advanced JSON Schema';

    protected string $moduleName;
    protected string $singular;
    protected string $plural;
    protected array $fields = [];

    public function handle(): int
    {
        $this->moduleName = ucfirst($this->argument('name'));
        $this->singular = Str::snake($this->moduleName);
        $this->plural = Str::plural($this->singular);

        if ($this->option('json')) {
            $path = base_path("_dataApp/" . $this->option('json'));
            if (!File::exists($path)) {
                $this->error("❌ Error: JSON file not found at {$path}");
                return 1;
            }
            $this->fields = json_decode(File::get($path), true);
        } else {
            $this->fields = [['name' => 'name', 'type' => 'string', 'style' => 'default', 'rules' => 'required']];
        }

        if (!$this->validateDependency()) {
            return 1;
        }

        $this->components->info("🔨 Building module [{$this->moduleName}]...");

        $this->generateFolders();
        $this->generateMigration();
        $this->generateModel();
        $this->generateInterfaces();
        $this->generateRepository();
        $this->generateService();
        $this->generateRequests();
        $this->generateController();
        $this->generateRoutes();
        $this->generateViews();
        $this->registerModuleBindings();

        $this->info("🚀 Module [{$this->moduleName}] built successfully!");
        return 0;
    }

    private function validateDependency(): bool
    {
        foreach ($this->fields as $field) {
            if (isset($field['relation'])) {
                $targetModel = ucfirst(Str::camel($field['relation']));
                if (!File::exists(app_path("Models/{$targetModel}.php"))) {
                    $this->error("Target Model [{$targetModel}] missing! Please build it first.");
                    return false;
                }
            }
        }
        return true;
    }

    private function generateFolders(): void
    {
        $paths = [
            "app/Services/Contracts",
            "app/Repositories/Contracts",
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
        $fillable = collect($this->fields)->map(fn($f) => "'{$f['name']}'")->implode(', ');
        $relations = "";

        $traits = ["HasUuids"];
        $imports = ["use Illuminate\Database\Eloquent\Concerns\HasUuids;"];

        if ($hasSlug) {
            $traits[] = "HasSlug";
            $imports[] = "use Spatie\Sluggable\HasSlug;";
            $imports[] = "use Spatie\Sluggable\SlugOptions;";
        }

        $traitString = "use " . implode(', ', $traits) . ";";
        $importString = implode("\n", $imports);
        $slugMethod = "";

        if ($hasSlug) {
            $sourceField = collect($this->fields)->contains('name', 'name') ? 'name' : $this->fields[0]['name'];
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

use Illuminate\Database\Eloquent\Model;
{$importString}

class {$this->moduleName} extends Model 
{
    {$traitString}

    protected \$keyType = 'string';
    public \$incrementing = false;
    protected \$fillable = [{$fillable}];
{$slugMethod}{$relations}
}
PHP;
        File::put(app_path("Models/{$this->moduleName}.php"), $content);
    }

    private function generateInterfaces(): void
    {
        $repo = "<?php\n\nnamespace App\Repositories\Contracts;\n\ninterface {$this->moduleName}RepositoryInterface\n{\n    public function getQuery();\n    public function find(string \$id);\n    public function store(array \$data);\n    public function update(string \$id, array \$data);\n    public function delete(string \$id);\n}";
        $service = "<?php\n\nnamespace App\Services\Contracts;\n\ninterface {$this->moduleName}ServiceInterface\n{\n    public function listTable();\n    public function find(string \$id);\n    public function store(array \$data);\n    public function update(string \$id, array \$data);\n    public function delete(string \$id);\n}";
        
        File::put(app_path("Repositories/Contracts/{$this->moduleName}RepositoryInterface.php"), $repo);
        File::put(app_path("Services/Contracts/{$this->moduleName}ServiceInterface.php"), $service);
    }

    private function generateRepository(): void
    {
        $content = <<<PHP
<?php

namespace App\Repositories;

use App\Models\\{$this->moduleName};
use App\Repositories\Contracts\\{$this->moduleName}RepositoryInterface;

class {$this->moduleName}Repository implements {$this->moduleName}RepositoryInterface 
{
    protected \$model;

    public function __construct({$this->moduleName} \$model) 
    { 
        \$this->model = \$model; 
    }

    public function getQuery() { return \$this->model->query(); }
    public function find(string \$id) { return \$this->model->findOrFail(\$id); }
    public function store(array \$data) { return \$this->model->create(\$data); }
    public function update(string \$id, array \$data) 
    { 
        \$row = \$this->find(\$id); 
        \$row->update(\$data); 
        return \$row; 
    }
    public function delete(string \$id) { return \$this->find(\$id)->delete(); }
}
PHP;
        File::put(app_path("Repositories/{$this->moduleName}Repository.php"), $content);
    }

    private function generateService(): void
    {
        $content = <<<PHP
<?php

namespace App\Services;

use App\Repositories\Contracts\\{$this->moduleName}RepositoryInterface;
use App\Services\Contracts\\{$this->moduleName}ServiceInterface;

class {$this->moduleName}Service implements {$this->moduleName}ServiceInterface 
{
    protected \$repo;

    public function __construct({$this->moduleName}RepositoryInterface \$repo) 
    { 
        \$this->repo = \$repo; 
    }

    public function listTable() { return \$this->repo->getQuery(); }
    public function find(string \$id) { return \$this->repo->find(\$id); }
    public function store(array \$data) { return \$this->repo->store(\$data); }
    public function update(string \$id, array \$data) { return \$this->repo->update(\$id, \$data); }
    public function delete(string \$id) { return \$this->repo->delete(\$id); }
}
PHP;
        File::put(app_path("Services/{$this->moduleName}Service.php"), $content);
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
        $relationData = ""; $relationVars = []; $uploadLogic = "";
        $hasUserId = collect($this->fields)->contains('name', 'user_id');

        foreach ($this->fields as $f) {
            if (isset($f['relation']) && $f['name'] !== 'user_id') {
                $mTarget = ucfirst(Str::camel($f['relation']));
                $vName = Str::plural(Str::camel($f['relation']));
                $relationData .= "\n        \${$vName} = \\App\\Models\\{$mTarget}::all();";
                $relationVars[] = "'{$vName}'";
            }
            if ($f['type'] === 'image') {
                $uploadLogic .= "        if (\$r->hasFile('{$f['name']}')) {\n            \$data['{$f['name']}'] = \$r->file('{$f['name']}')->store('modules/{$this->plural}', 'public');\n        }\n";
            }
        }

        $authImport = $hasUserId ? "use Illuminate\Support\Facades\Auth;" : "";
        $authLogic = $hasUserId ? "        \$data['user_id'] = Auth::id();\n" : "";

        // --- FIX LOGIC COMPACT DISINI ---
        $createCompact = count($relationVars) > 0 
            ? ", compact(" . implode(', ', $relationVars) . ")" 
            : "";
        
        $editVars = array_merge(["'{$this->singular}'"], $relationVars);
        $editCompact = ", compact(" . implode(', ', $editVars) . ")";
        // --------------------------------

        $dt = $this->option('datatable') ? "    public function list() \n    {\n        return datatables()->of(\$this->service->listTable())->addIndexColumn()\n            ->addColumn('action', fn(\$row) => view('modules.{$this->singular}.action', compact('row'))->render())\n            ->rawColumns(['action'])->toJson();\n    }\n" : "";
        
        $content = <<<PHP
<?php

namespace App\Http\Controllers;

use App\Http\Requests\{Store{$this->moduleName}Request, Update{$this->moduleName}Request};
use App\Services\Contracts\\{$this->moduleName}ServiceInterface;
{$authImport}

class {$this->moduleName}Controller extends Controller 
{
    protected \$service;

    public function __construct({$this->moduleName}ServiceInterface \$service) 
    { 
        \$this->service = \$service; 
    }

    public function index() 
    { 
        return view('modules.{$this->singular}.index'); 
    }

{$dt}
    public function create() 
    { {$relationData}
        return view('modules.{$this->singular}.form'{$createCompact});
    }

    public function store(Store{$this->moduleName}Request \$r) 
    {
        \$data = \$r->validated();
{$authLogic}{$uploadLogic}        \$this->service->store(\$data);
        return redirect()->route('{$this->plural}.index');
    }

    public function edit(\$id) 
    { 
        \${$this->singular} = \$this->service->find(\$id); {$relationData}
        return view('modules.{$this->singular}.form'{$editCompact});
    }

    public function update(Update{$this->moduleName}Request \$r, \$id) 
    {
        \$data = \$r->validated();
{$authLogic}{$uploadLogic}        \$this->service->update(\$id, \$data);
        return redirect()->route('{$this->plural}.index');
    }

    public function destroy(\$id) 
    { 
        \$this->service->delete(\$id); 
        return back(); 
    }
}
PHP;
        File::put(app_path("Http/Controllers/{$this->moduleName}Controller.php"), $content);
    }

    private function generateRoutes(): void
    {
        $dtRoute = $this->option('datatable') ? "Route::get('{$this->plural}/list', [{$this->moduleName}Controller::class, 'list'])->name('{$this->plural}.list');" : "";
        $content = "<?php\n\nuse App\Http\Controllers\\{$this->moduleName}Controller;\nuse Illuminate\Support\Facades\Route;\n\n{$dtRoute}\nRoute::resource('{$this->plural}', {$this->moduleName}Controller::class)->parameters(['{$this->plural}' => 'uuid']);";
        File::put(base_path("routes/modules/{$this->singular}.php"), $content);
        
        $web = base_path('routes/web.php');
        $line = "require __DIR__.'/modules/{$this->singular}.php';";
        if (!Str::contains(File::get($web), $line)) {
            File::append($web, "\n".$line);
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

        $displayField = $displayField ?? $this->fields[0];
        $displayFieldName = $displayField['name'];
        $displayLabel = Str::title(str_replace('_', ' ', $displayFieldName));
        
        // Action View
        File::put(base_path("{$path}/action.blade.php"), "<div class='btn-group'><a href='{{ route('{$this->plural}.edit', \$row->id) }}' class='btn btn-sm btn-primary'><i class='feather icon-edit'></i></a><button type='button' class='btn btn-sm btn-danger' onclick=\"handleDelete('{{ route('{$this->plural}.destroy', \$row->id) }}')\"><i class='feather icon-trash'></i></button></div>");

        // Index View
        $dt = $this->option('datatable') ? "<x-table.datatable-script id='{$this->singular}-table' :url=\"route('{$this->plural}.list')\" :columns=\"[['data'=>'DT_RowIndex'],['data'=>'{$displayFieldName}'],['data'=>'action']]\" :order=\"[1, 'asc']\" />" : "";
        $index = "@extends('layouts.app')\n\n@section('content')\n<div class='card'>\n    <div class='card-header'>\n        <h4 class='card-title'>{$this->moduleName}</h4>\n        <a href='{{ route('{$this->plural}.create') }}' class='btn btn-primary'>Add New</a>\n    </div>\n    <div class='card-body'>\n        <div class='table-responsive'>\n            <table class='table' id='{$this->singular}-table'>\n                <thead>\n                    <tr>\n                        <th>No</th>\n                        <th>{$displayLabel}</th>\n                        <th>Action</th>\n                    </tr>\n                </thead>\n            </table>\n        </div>\n    </div>\n</div>\n{$dt}\n@endsection";
        File::put(base_path("{$path}/index.blade.php"), $index);

        // Form View
        $fieldsHtml = "";
        foreach ($this->fields as $f) {
            if (in_array($f['name'], ['slug', 'user_id'])) continue;
            $label = Str::title(str_replace('_', ' ', $f['name']));
            $style = $f['style'] ?? 'default';
            
            if (isset($f['relation'])) {
                $vName = Str::plural(Str::camel($f['relation']));
                $fieldsHtml .= "        <x-form.select name='{$f['name']}' label='{$label}'>\n            <option value='' required selected>Select {$label}</option>\n            @foreach(\${$vName} as \$item)\n                <option value='{{ \$item->id }}' {{ (old('{$f['name']}', \${$this->singular}->{$f['name']} ?? '') == \$item->id) ? 'selected' : '' }}>{{ \$item->name }}</option>\n            @endforeach\n        </x-form.select>\n";
            } elseif ($f['type'] === 'image') {
                $fieldsHtml .= "        <x-form.photo-upload label='{$label}' name='{$f['name']}' :value=\"\${$this->singular}->{$f['name']} ?? null\" rounded='circle' />\n";
            } else {
                $fieldsHtml .= match($style) {
                    'datepicker' => "        <x-form.datepicker name='{$f['name']}' label='{$label}' :value=\"\${$this->singular}->{$f['name']} ?? ''\" />\n",
                    'switch'     => "        <x-form.switch name='{$f['name']}' label='{$label}' :checked=\"\${$this->singular}->{$f['name']} ?? false\" />\n",
                    'textarea'   => "        <x-form.textarea name='{$f['name']}' label='{$label}'>{{ \${$this->singular}->{$f['name']} ?? '' }}</x-form.textarea>\n",
                    default      => "        <x-form.input name='{$f['name']}' label='{$label}' :value=\"\${$this->singular}->{$f['name']} ?? ''\" floating divider />\n",
                };
            }
        }
        $form = "@php \$isEdit = isset(\${$this->singular}); @endphp\n@extends('layouts.app')\n\n@section('content')\n<div class='card'>\n    <div class='card-body'>\n        <form action=\"{{ \$isEdit ? route('{$this->plural}.update', \${$this->singular}->id) : route('{$this->plural}.store') }}\" method='POST' {$enctype} novalidate>\n            @csrf\n            @if(\$isEdit) @method('PUT') @endif\n\n{$fieldsHtml}\n            <div class='mt-3'>\n                <button type='submit' class='btn btn-primary'>Save Data</button>\n                <a href='{{ route('{$this->plural}.index') }}' class='btn btn-outline-secondary'>Back</a>\n            </div>\n        </form>\n    </div>\n</div>\n@endsection";
        File::put(base_path("{$path}/form.blade.php"), $form);
    }

    private function registerModuleBindings(): void
    {
        $path = app_path('Providers/ModuleServiceProvider.php');
        $binding = "\$this->app->bind(\\App\\Services\\Contracts\\{$this->moduleName}ServiceInterface::class, \\App\\Services\\{$this->moduleName}Service::class);\n        \$this->app->bind(\\App\\Repositories\\Contracts\\{$this->moduleName}RepositoryInterface::class, \\App\\Repositories\\{$this->moduleName}Repository::class);\n        // MODULE_BINDINGS";
        
        if (!File::exists($path)) {
            File::put($path, "<?php\n\nnamespace App\Providers;\n\nuse Illuminate\Support\ServiceProvider;\n\nclass ModuleServiceProvider extends ServiceProvider\n{\n    public function register(): void\n    {\n        // MODULE_BINDINGS\n    }\n}");
            $this->registerToBootstrap();
        }

        $content = File::get($path);
        if (!Str::contains($content, "{$this->moduleName}ServiceInterface")) {
            File::put($path, str_replace('// MODULE_BINDINGS', $binding, $content));
        }
    }

    private function registerToBootstrap(): void
    {
        $path = base_path('bootstrap/providers.php');
        if (File::exists($path)) {
            $content = File::get($path);
            if (!Str::contains($content, 'ModuleServiceProvider::class')) {
                File::put($path, str_replace('];', "    App\Providers\ModuleServiceProvider::class,\n];", $content));
            }
        }
    }
}