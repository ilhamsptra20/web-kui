<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('videos') || Schema::hasColumn('videos', 'is_active')) {
            return;
        }

        Schema::table('videos', function (Blueprint $table): void {
            $table->boolean('is_active')->default(false)->after('thumbnail')->index();
        });

        $firstVideoId = DB::table('videos')->orderBy('created_at')->value('id');

        if ($firstVideoId) {
            DB::table('videos')
                ->where('id', $firstVideoId)
                ->update(['is_active' => true]);
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('videos') || ! Schema::hasColumn('videos', 'is_active')) {
            return;
        }

        Schema::table('videos', function (Blueprint $table): void {
            $table->dropIndex(['is_active']);
            $table->dropColumn('is_active');
        });
    }
};
