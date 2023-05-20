<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('users', function ($table) {
            $table->foreignId('role_id')
                ->unsigned()->nullable()
                ->constrained('roles')
                ->cascadeOnUpdate()->nullOnDelete();
            $table->double('wallet')->default(0.0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
