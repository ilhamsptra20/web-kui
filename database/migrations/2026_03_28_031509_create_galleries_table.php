<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void 
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('album_id')->nullable();
            $table->string('title_id')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void 
    { 
        Schema::dropIfExists('galleries'); 
    }
};