<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('navigations', function (Blueprint $table): void {
            $table->string('module_key', 100)->nullable()->after('type');
        });
    }

    public function down(): void
    {
        Schema::table('navigations', function (Blueprint $table): void {
            $table->dropColumn('module_key');
        });
    }
};
