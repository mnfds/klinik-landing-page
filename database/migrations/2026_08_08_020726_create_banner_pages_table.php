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
        Schema::create('banner_pages', function (Blueprint $table) {
            $table->id();
            $table->text('text_badge')->nullable();
            $table->text('text_title')->nullable();
            $table->text('text_description')->nullable();
            $table->string('image_mobile')->nullable();
            $table->string('image_desktop')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner_pages');
    }
};
