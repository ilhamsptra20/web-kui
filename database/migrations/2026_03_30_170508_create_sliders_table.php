<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void 
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('subtitle_id')->nullable();
            $table->string('subtitle_en')->nullable();
            $table->string('subtitle_ar')->nullable();
            $table->text('title_id')->nullable();
            $table->text('title_en')->nullable();
            $table->text('title_ar')->nullable();
            $table->text('description_id')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->string('btn_text_id')->nullable();
            $table->string('btn_text_en')->nullable();
            $table->string('btn_text_ar')->nullable();
            $table->string('btn_url')->nullable();
            $table->string('image')->nullable();
            $table->integer('order')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void 
    { 
        Schema::dropIfExists('sliders'); 
    }
};