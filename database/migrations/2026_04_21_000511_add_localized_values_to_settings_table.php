<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('settings')) {
            return;
        }

        Schema::table('settings', function (Blueprint $table): void {
            if (! Schema::hasColumn('settings', 'value_id')) {
                $table->text('value_id')->nullable()->after('value');
            }

            if (! Schema::hasColumn('settings', 'value_en')) {
                $table->text('value_en')->nullable()->after('value_id');
            }

            if (! Schema::hasColumn('settings', 'value_ar')) {
                $table->text('value_ar')->nullable()->after('value_en');
            }
        });

        DB::table('settings')
            ->whereNull('value_id')
            ->update(['value_id' => DB::raw('value')]);
    }

    public function down(): void
    {
        if (! Schema::hasTable('settings')) {
            return;
        }

        Schema::table('settings', function (Blueprint $table): void {
            foreach (['value_ar', 'value_en', 'value_id'] as $column) {
                if (Schema::hasColumn('settings', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
