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
        Schema::create('shows', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("platform"); //  cinema or OTT
            $table->string("location")->nullable();
            $table->string("city");
            $table->time("show_time")->nullable();
            $table->date("show_date")->nullable();
            $table->foreignId("movie_id")->constrained()->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shows');
    }
};
