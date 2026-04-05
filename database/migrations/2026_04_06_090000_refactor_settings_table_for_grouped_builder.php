<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('settings')) {
            return;
        }

        Schema::table('settings', function (Blueprint $table): void {
            if (! Schema::hasColumn('settings', 'group')) {
                $table->string('group', 100)->nullable()->after('id');
            }

            if (! Schema::hasColumn('settings', 'label')) {
                $table->string('label', 100)->nullable()->after('group');
            }

            if (! Schema::hasColumn('settings', 'type')) {
                $table->enum('type', Setting::typeValues())->nullable()->after('key');
            }
        });

        $usedKeys = [];

        DB::table('settings')
            ->orderBy('created_at')
            ->get()
            ->each(function (object $setting) use (&$usedKeys): void {
                $baseKey = Str::of((string) ($setting->key ?? ''))
                    ->trim()
                    ->lower()
                    ->replaceMatches('/[^a-z0-9._-]+/', '_')
                    ->trim('_')
                    ->value();

                if ($baseKey === '') {
                    $baseKey = 'setting_' . Str::lower(Str::substr((string) $setting->id, 0, 8));
                }

                $uniqueKey = Str::limit($baseKey, 100, '');
                $suffix = 1;

                while (in_array($uniqueKey, $usedKeys, true)) {
                    $uniqueKey = Str::limit($baseKey, 95, '') . '_' . $suffix;
                    $suffix++;
                }

                $usedKeys[] = $uniqueKey;

                DB::table('settings')
                    ->where('id', $setting->id)
                    ->update([
                        'group' => filled($setting->group ?? null) ? $setting->group : 'General',
                        'label' => filled($setting->label ?? null)
                            ? $setting->label
                            : Str::headline(str_replace(['_', '-', '.'], ' ', $uniqueKey)),
                        'key' => $uniqueKey,
                        'type' => in_array($setting->type ?? null, Setting::typeValues(), true)
                            ? $setting->type
                            : Setting::TYPE_TEXT,
                    ]);
            });

        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE `settings` MODIFY `group` VARCHAR(100) NOT NULL");
            DB::statement("ALTER TABLE `settings` MODIFY `label` VARCHAR(100) NOT NULL");
            DB::statement("ALTER TABLE `settings` MODIFY `key` VARCHAR(100) NOT NULL");
            DB::statement("ALTER TABLE `settings` MODIFY `type` ENUM('text','longtext','image','list') NOT NULL");
        }

        Schema::table('settings', function (Blueprint $table): void {
            $table->unique('key');
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('settings')) {
            return;
        }

        Schema::table('settings', function (Blueprint $table): void {
            $table->dropUnique(['key']);
            $table->dropColumn(['group', 'label', 'type']);
        });
    }
};
