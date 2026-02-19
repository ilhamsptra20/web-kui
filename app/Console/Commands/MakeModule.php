<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeModule extends Command
{
    protected $signature = 'make:module {name} {--datatable} {--json=}';
    protected $description = 'Professional Module Scaffolder with Advanced JSON Schema';

    protected $moduleName, $singular, $plural, $fields = [];

    public function handle()
    {
        $this->moduleName = ucfirst($this->argument('name'));
        $this->singular = Str::snake($this->moduleName);
        $this->plural = Str::plural($this->singular);

        if ($this->option('json')) {
            $path = base_path("_dataApp/" . $this->option('json'));
            if (!File::exists($path)) {
                $this->error("❌ Error: File JSON tidak ditemukan di {$path}");
                return 1;
            }
            $this->fields = json_decode(File::get($path), true);
        } else {
            $this->fields = [['name' => 'name', 'type' => 'string', 'style' => 'default', 'rules' => 'required']];
        }

        if (!$this->validateDependency()) return 1;

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

        $this->info("🚀 Module [{$this->moduleName}] built successfully based on your schema!");
        return 0;
    }

    private function validateDependency()
    {
        foreach ($this->fields as $field) {
            if (isset($field['relation'])) {
                $targetModel = ucfirst(Str::camel($field['relation']));
                if (!File::exists(app_path("Models/{$targetModel}.php"))) {
                    $this->error("Target Model [ {$targetModel} ] missing! Build it first.");
                    return false;
                }
            }
        }
        return true;
    }

    private function generateFolders()
    {
        $paths = [
            "app/Services/Contracts", "app/Repositories/Contracts", "app/Http/Requests",
            "routes/modules", "resources/views/modules/{$this->singular}"
        ];
        foreach ($paths as $path) File::ensureDirectoryExists(base_path($path));
    }

    private function generateMigration()
    {
        $lines = "";
        foreach ($this->fields as $f) {
            $type = $f['type'];
            $name = $f['name'];

            if ($type == 'image') {
                $lines .= "            \$table->string('{$name}')->nullable();\n";
                continue;
            }

            $line = "\$table->{$type}('{$name}')";
            if ($type == 'string' && isset($f['length'])) $line = "\$table->string('{$name}', {$f['length']})";
            
            $lines .= "            {$line}->nullable();\n";
        }

        $content = "<?php\n\nuse Illuminate\Database\Migrations\Migration;\nuse Illuminate\Database\Schema\Blueprint;\nuse Illuminate\Support\Facades\Schema;\n\nreturn new class extends Migration {\n    public function up(): void {\n        Schema::create('{$this->plural}', function (Blueprint \$table) {\n            \$table->uuid('id')->primary();\n{$lines}            \$table->timestamps();\n        });\n    }\n    public function down(): void { Schema::dropIfExists('{$this->plural}'); }\n};";
        File::put(database_path("migrations/".date('Y_m_d_His')."_create_{$this->plural}_table.php"), $content);
    }

    private function generateModel()
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
            // Kita asumsikan slug dibuat dari field 'name' atau field pertama
            $sourceField = collect($this->fields)->contains('name', 'name') ? 'name' : $this->fields[0]['name'];
            $slugMethod = "\n    public function getSlugOptions() : SlugOptions\n    {\n        return SlugOptions::create()\n            ->generateSlugsFrom('{$sourceField}')\n            ->saveSlugsTo('slug');\n    }\n";
        }

        foreach ($this->fields as $f) {
            if (isset($f['relation'])) {
                $method = ($f['name'] === 'user_id') ? 'user' : Str::camel($f['relation']);
                $model = ($f['name'] === 'user_id') ? 'User' : ucfirst(Str::camel($f['relation']));
                $relations .= "\n    public function {$method}()\n    {\n        return \$this->belongsTo({$model}::class, '{$f['name']}');\n    }\n";
            }
        }

        $content = "<?php\n\nnamespace App\Models;\n\nuse Illuminate\Database\Eloquent\Model;\n{$importString}\n\nclass {$this->moduleName} extends Model {\n    {$traitString}\n    protected \$keyType = 'string';\n    public \$incrementing = false;\n    protected \$fillable = [{$fillable}];\n{$slugMethod}{$relations}\n}";
        File::put(app_path("Models/{$this->moduleName}.php"), $content);
    }

    private function generateInterfaces()
    {
        $repo = "<?php\nnamespace App\Repositories\Contracts;\ninterface {$this->moduleName}RepositoryInterface {\n    public function getQuery();\n    public function find(string \$id);\n    public function store(array \$data);\n    public function update(string \$id, array \$data);\n    public function delete(string \$id);\n}";
        $service = "<?php\nnamespace App\Services\Contracts;\ninterface {$this->moduleName}ServiceInterface {\n    public function listTable();\n    public function find(string \$id);\n    public function store(array \$data);\n    public function update(string \$id, array \$data);\n    public function delete(string \$id);\n}";
        File::put(app_path("Repositories/Contracts/{$this->moduleName}RepositoryInterface.php"), $repo);
        File::put(app_path("Services/Contracts/{$this->moduleName}ServiceInterface.php"), $service);
    }

    private function generateRepository()
    {
        $content = "<?php\nnamespace App\Repositories;\nuse App\Models\\{$this->moduleName};\nuse App\Repositories\Contracts\\{$this->moduleName}RepositoryInterface;\nclass {$this->moduleName}Repository implements {$this->moduleName}RepositoryInterface {\n    protected \$model;\n    public function __construct({$this->moduleName} \$model) { \$this->model = \$model; }\n    public function getQuery() { return \$this->model->query(); }\n    public function find(string \$id) { return \$this->model->findOrFail(\$id); }\n    public function store(array \$data) { return \$this->model->create(\$data); }\n    public function update(string \$id, array \$data) { \$row = \$this->find(\$id); \$row->update(\$data); return \$row; }\n    public function delete(string \$id) { return \$this->find(\$id)->delete(); }\n}";
        File::put(app_path("Repositories/{$this->moduleName}Repository.php"), $content);
    }

    private function generateService()
    {
        $content = "<?php\nnamespace App\Services;\nuse App\Repositories\Contracts\\{$this->moduleName}RepositoryInterface;\nuse App\Services\Contracts\\{$this->moduleName}ServiceInterface;\nclass {$this->moduleName}Service implements {$this->moduleName}ServiceInterface {\n    protected \$repo;\n    public function __construct({$this->moduleName}RepositoryInterface \$repo) { \$this->repo = \$repo; }\n    public function listTable() { return \$this->repo->getQuery(); }\n    public function find(string \$id) { return \$this->repo->find(\$id); }\n    public function store(array \$data) { return \$this->repo->store(\$data); }\n    public function update(string \$id, array \$data) { return \$this->repo->update(\$id, \$data); }\n    public function delete(string \$id) { return \$this->repo->delete(\$id); }\n}";
        File::put(app_path("Services/{$this->moduleName}Service.php"), $content);
    }

    private function generateRequests()
    {
        foreach (['Store', 'Update'] as $t) {
            $rules = "";
            foreach ($this->fields as $f) {
                if (in_array($f['name'], ['slug', 'user_id'])) continue;

                $rule = $f['rules'] ?? 'required';
                // Handle image rules specifically if it's an update
                if ($f['type'] == 'image' && $t == 'Update') {
                    $rule = str_replace('required', 'nullable', $rule);
                }
                $rules .= "            '{$f['name']}' => '{$rule}',\n";
            }
            $content = "<?php\nnamespace App\Http\Requests;\nuse Illuminate\Foundation\Http\FormRequest;\nclass {$t}{$this->moduleName}Request extends FormRequest {\n    public function authorize() { return true; }\n    public function rules() {\n        return [\n{$rules}        ];\n    }\n}";
            File::put(app_path("Http/Requests/{$t}{$this->moduleName}Request.php"), $content);
        }
    }

    private function generateController()
    {
        $relationData = ""; $relationVars = []; $uploadLogic = "";
        $hasUserId = collect($this->fields)->contains('name', 'user_id'); // Cek field user_id

        foreach ($this->fields as $f) {
            if (isset($f['relation']) && $f['name'] !== 'user_id') {
                $mTarget = ucfirst(Str::camel($f['relation']));
                $vName = Str::plural(Str::camel($f['relation']));
                $relationData .= "\n        \${$vName} = \\App\\Models\\{$mTarget}::all();";
                $relationVars[] = "'{$vName}'";
            }
            if ($f['type'] == 'image') {
                $uploadLogic .= "        if (\$r->hasFile('{$f['name']}')) \$data['{$f['name']}'] = \$r->file('{$f['name']}')->store('modules/{$this->plural}', 'public');\n";
            }
        }
        $authLogic = $hasUserId ? "        \$data['user_id'] = Auth::id();\n" : "";

        $relationCompact = count($relationVars) > 0 ? implode(', ', $relationVars) : "";
        $editCompact = count($relationVars) > 0 ? $relationCompact . ", '{$this->singular}'" : "'{$this->singular}'";

        $dt = $this->option('datatable') ? "    public function list() {\n        return datatables()->of(\$this->service->listTable())->addIndexColumn()\n            ->addColumn('action', fn(\$row) => view('modules.{$this->singular}.action', compact('row'))->render())\n            ->rawColumns(['action'])->toJson();\n    }\n" : "";
        
        $content = "<?php\n\nnamespace App\Http\Controllers;\n\nuse App\Http\Requests\{Store{$this->moduleName}Request, Update{$this->moduleName}Request};\nuse App\Services\Contracts\\{$this->moduleName}ServiceInterface;\n\nclass {$this->moduleName}Controller extends Controller {\n    protected \$service;\n\n    public function __construct({$this->moduleName}ServiceInterface \$service) { \$this->service = \$service; }\n\n    public function index() { return view('modules.{$this->singular}.index'); }\n\n{$dt}\n    public function create() { {$relationData}\n        return view('modules.{$this->singular}.form'" . ($relationCompact ? ", compact({$relationCompact})" : "") . ");\n    }\n\n    public function store(Store{$this->moduleName}Request \$r) {\n        \$data = \$r->validated();\n{$authLogic}{$uploadLogic}        \$this->service->store(\$data);\n        return redirect()->route('{$this->plural}.index');\n    }\n\n    public function edit(\$id) { \${$this->singular} = \$this->service->find(\$id); {$relationData}\n        return view('modules.{$this->singular}.form', compact({$editCompact}));\n    }\n\n    public function update(Update{$this->moduleName}Request \$r, \$id) {\n        \$data = \$r->validated();\n{$authLogic}{$uploadLogic}        \$this->service->update(\$id, \$data);\n        return redirect()->route('{$this->plural}.index');\n    }\n\n    public function destroy(\$id) { \$this->service->delete(\$id); return back(); }\n}";
        
        File::put(app_path("Http/Controllers/{$this->moduleName}Controller.php"), $content);
    }

    private function generateRoutes()
    {
        $dtRoute = $this->option('datatable') ? "Route::get('{$this->plural}/list', [{$this->moduleName}Controller::class, 'list'])->name('{$this->plural}.list');" : "";
        $content = "<?php\nuse App\Http\Controllers\\{$this->moduleName}Controller;\nuse Illuminate\Support\Facades\Route;\n{$dtRoute}\nRoute::resource('{$this->plural}', {$this->moduleName}Controller::class)->parameters(['{$this->plural}' => 'uuid']);";
        File::put(base_path("routes/modules/{$this->singular}.php"), $content);
        
        $web = base_path('routes/web.php');
        $line = "require __DIR__.'/modules/{$this->singular}.php';";
        if (!Str::contains(File::get($web), $line)) File::append($web, "\n".$line);
    }

    private function generateViews()
    {
        $path = "resources/views/modules/{$this->singular}";
        $hasImage = collect($this->fields)->contains('type', 'image');
        $enctype = $hasImage ? 'enctype="multipart/form-data"' : '';

        // --- LOGIC CERDAS DETEKSI FIELD UTAMA ---
        $fieldsCollection = collect($this->fields);

        // 1. Coba cari field yang namanya pas 'name'
        $displayField = $fieldsCollection->firstWhere('name', 'name');

        // 2. Kalau nggak ada, cari field pertama yang tipe-nya bukan image DAN namanya tidak berakhiran '_id'
        if (!$displayField) {
            $displayField = $fieldsCollection->first(function ($f) {
                return $f['type'] !== 'image' && !Str::endsWith($f['name'], '_id');
            });
        }

        // 3. Kalau masih nggak ketemu juga (misal isinya cuma ID semua), terpaksa ambil yang pertama banget
        $displayField = $displayField ?? $this->fields[0];
        
        $displayFieldName = $displayField['name'];
        $displayLabel = Str::title(str_replace('_', ' ', $displayFieldName));
        // ----------------------------------------
        
        // Action View
        File::put(base_path("{$path}/action.blade.php"), "<div class='btn-group'><a href='{{ route('{$this->plural}.edit', \$row->id) }}' class='btn btn-sm btn-primary'><i class='feather icon-edit'></i></a><button type='button' class='btn btn-sm btn-danger' onclick=\"handleDelete('{{ route('{$this->plural}.destroy', \$row->id) }}')\"><i class='feather icon-trash'></i></button></div>");

        // Index View (Datatable)
        $dt = $this->option('datatable') ? "<x-table.datatable-script id='{$this->singular}-table' :url=\"route('{$this->plural}.list')\" :columns=\"[['data'=>'DT_RowIndex'],['data'=>'{$displayFieldName}'],['data'=>'action']]\" :order=\"[1, 'asc']\" />" : "";
        
        $index = "@extends('layouts.app')\n@section('content')\n<div class='card'><div class='card-header'><h4 class='card-title'>{$this->moduleName}</h4><a href='{{ route('{$this->plural}.create') }}' class='btn btn-primary'>Add</a></div><div class='card-body'><div class='table-responsive'><table class='table' id='{$this->singular}-table'><thead><tr><th>No</th><th>{$displayLabel}</th><th>Action</th></tr></thead></table></div></div></div>\n{$dt}\n@endsection";
        File::put(base_path("{$path}/index.blade.php"), $index);

        // Form View (Looping semua field untuk input)
        $fieldsHtml = "";
        foreach ($this->fields as $f) {
            if (in_array($f['name'], ['slug', 'user_id'])) continue;
            $label = Str::title(str_replace('_', ' ', $f['name']));
            $style = $f['style'] ?? 'default';
            
            if (isset($f['relation'])) {
                $vName = Str::plural(Str::camel($f['relation']));
                $fieldsHtml .= "            <x-form.select name='{$f['name']}' label='{$label}'>\n                @foreach(\${$vName} as \$item)\n                    <option value='{{ \$item->id }}' {{ (old('{$f['name']}', \${$this->singular}->{$f['name']} ?? '') == \$item->id) ? 'selected' : '' }}>{{ \$item->name }}</option>\n                @endforeach\n            </x-form.select>\n";
            } elseif ($f['type'] == 'image') {
                $fieldsHtml .= "            <x-form.photo-upload label='{$label}' name='{$f['name']}' :value=\"\${$this->singular}->{$f['name']} ?? null\" rounded='circle' />\n";
            } else {
                $fieldsHtml .= match($style) {
                    'datepicker' => "            <x-form.datepicker name='{$f['name']}' label='{$label}' :value=\"\${$this->singular}->{$f['name']} ?? ''\" />\n",
                    'switch'     => "            <x-form.switch name='{$f['name']}' label='{$label}' :checked=\"\${$this->singular}->{$f['name']} ?? false\" />\n",
                    'textarea'   => "            <x-form.textarea name='{$f['name']}' label='{$label}'>{{ \${$this->singular}->{$f['name']} ?? '' }}</x-form.textarea>\n",
                    default      => "            <x-form.input name='{$f['name']}' label='{$label}' :value=\"\${$this->singular}->{$f['name']} ?? ''\" floating divider />\n",
                };
            }
        }
        $form = "@php \$isEdit = isset(\${$this->singular}); @endphp\n@extends('layouts.app')\n@section('content')\n<div class='card'><div class='card-body'><form action=\"{{ \$isEdit ? route('{$this->plural}.update', \${$this->singular}->id) : route('{$this->plural}.store') }}\" method='POST' {$enctype} novalidate>@csrf @if(\$isEdit) @method('PUT') @endif\n{$fieldsHtml}<button type='submit' class='btn btn-primary mt-2'>Save</button></form></div></div>@endsection";
        File::put(base_path("{$path}/form.blade.php"), $form);
    }

    private function registerModuleBindings()
    {
        $path = app_path('Providers/ModuleServiceProvider.php');
        $binding = "\$this->app->bind(\\App\\Services\\Contracts\\{$this->moduleName}ServiceInterface::class, \\App\\Services\\{$this->moduleName}Service::class);\n        \$this->app->bind(\\App\\Repositories\\Contracts\\{$this->moduleName}RepositoryInterface::class, \\App\\Repositories\\{$this->moduleName}Repository::class);\n        // MODULE_BINDINGS";
        
        if (!File::exists($path)) {
            File::put($path, "<?php\n\nnamespace App\Providers;\n\nuse Illuminate\Support\ServiceProvider;\n\nclass ModuleServiceProvider extends ServiceProvider {\n    public function register(): void {\n        // MODULE_BINDINGS\n    }\n}");
            $this->registerToBootstrap();
        }

        $content = File::get($path);
        if (!Str::contains($content, "{$this->moduleName}ServiceInterface")) {
            File::put($path, str_replace('// MODULE_BINDINGS', $binding, $content));
        }
    }

    private function registerToBootstrap()
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