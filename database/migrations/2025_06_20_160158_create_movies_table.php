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
            $table->text('description');
            $table->float('rating', 3, 1)->default(0);
            $table->string('poster')->nullable();
            $table->string('link');
            $table->string('category')->nullable();
            $table->string('language')->default('English');
            $table->integer('duration')->nullable();
            $table->year('year')->nullable();
            // $table->foreignId("shows_id")->constrained()->onDelete("cascade");
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
