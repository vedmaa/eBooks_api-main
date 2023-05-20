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
        Schema::create('bookshelves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shelf_id')
                ->unsigned()->nullable()
                ->constrained('shelves')
                ->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('book_id')
                ->unsigned()->nullable()
                ->constrained('books')
                ->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookshelves');
    }
};
