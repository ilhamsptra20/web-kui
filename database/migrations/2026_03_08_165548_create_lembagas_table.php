<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void 
    {
        Schema::create('lembagas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name_id')->nullable();
            $table->string('slug')->nullable();
            $table->text('description_id')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void 
    { 
        Schema::dropIfExists('lembagas'); 
    }
};