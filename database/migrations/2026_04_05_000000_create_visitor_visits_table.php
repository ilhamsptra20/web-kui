<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('visitor_visits', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_key', 64);
            $table->string('session_id')->nullable();
            $table->string('route_name')->nullable();
            $table->string('first_path')->nullable();
            $table->string('last_path')->nullable();
            $table->string('browser_name')->default('Unknown');
            $table->string('browser_version')->nullable();
            $table->string('os_name')->default('Unknown');
            $table->string('os_version')->nullable();
            $table->string('device_type')->default('other');
            $table->boolean('is_bot')->default(false);
            $table->unsignedInteger('page_views')->default(1);
            $table->date('visited_on');
            $table->timestamp('first_visited_at');
            $table->timestamp('last_visited_at');
            $table->timestamps();

            $table->unique(['visitor_key', 'visited_on']);
            $table->index('visited_on');
            $table->index('browser_name');
            $table->index('os_name');
            $table->index('device_type');
            $table->index('is_bot');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_visits');
    }
};
