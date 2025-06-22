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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('title');
            $table->string('category', 100)->nullable(); // Added length for consistency
            $table->string('language', 100)->default('English'); // Added length
            $table->integer('duration')->nullable();
            $table->year('year')->nullable();

            $table->text('description');
            $table->float('rating', 3, 1)->default(0);

            $table->string('poster')->nullable(); // Store path to poster image
            $table->string('link', 2048)->nullable(); // Changed to nullable, increased length for URL
            $table->string('trailer_url', 2048); // Added this, not nullable as per form validation, increased length for URL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
