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
        Schema::create('home_section_settings', function (Blueprint $table) {
            $table->id();
            $table->string('language');
            $table->integer('category_section_one');
            $table->integer('category_section_two');
            $table->integer('category_section_three');
            $table->integer('category_section_four');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_section_settings');
    }
};
