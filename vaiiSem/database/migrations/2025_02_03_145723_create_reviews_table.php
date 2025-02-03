<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id')->constrained('product')->onDelete('cascade'); // Prepojenie s produktom
            $table->string('author'); // Meno autora recenzie
            $table->text('review'); // Text recenzie
            $table->tinyInteger('rating')->default(1); // Hodnotenie od 1 do 5
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
