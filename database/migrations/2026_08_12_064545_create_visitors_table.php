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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            // ID unik dari cookie browser
            $table->uuid('visitor_id');
            $table->ipAddress('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            // Halaman pertama yang dikunjungi hari itu
            $table->string('page')->nullable();
            $table->date('visited_date');
            $table->timestamps();
            // Satu visitor hanya dihitung sekali dalam satu hari
            $table->unique(['visitor_id', 'visited_date']);
            $table->index('visited_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
