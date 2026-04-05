<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('position_id')->nullable();
            $table->string('npp')->nullable();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->text('bio_id')->nullable();
            $table->text('bio_en')->nullable();
            $table->text('bio_ar')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};