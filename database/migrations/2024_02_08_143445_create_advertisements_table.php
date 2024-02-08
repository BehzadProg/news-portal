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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->text('home_topbar_ad');
            $table->text('home_topbar_ad_url')->nullable();
            $table->boolean('home_topbar_ad_status');
            $table->text('home_middle_ad');
            $table->text('home_middle_ad_url')->nullable();
            $table->boolean('home_middle_ad_status');
            $table->text('view_page_ad');
            $table->text('view_page_ad_url')->nullable();
            $table->boolean('view_page_ad_status');
            $table->text('news_page_ad');
            $table->text('news_page_ad_url')->nullable();
            $table->boolean('news_page_ad_status');
            $table->text('sidebar_ad');
            $table->text('sidebar_ad_url')->nullable();
            $table->boolean('sidebar_ad_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
