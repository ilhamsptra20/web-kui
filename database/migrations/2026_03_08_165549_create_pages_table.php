<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void 
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable();
            $table->string('title_id')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('slug')->nullable();
            $table->text('content_id')->nullable();
            $table->text('content_en')->nullable();
            $table->text('content_ar')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void 
    { 
        Schema::dropIfExists('pages'); 
    }
};