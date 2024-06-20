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
        Schema::create('pulls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('saller_id')->nullable()->references('id')->on('sallers')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('admin_id')->references('id')->on('admins')->cascadeOnDelete();
            $table->decimal('pull',8,2);
            $table->decimal('amount')->default(0);
            $table->enum('type' , ['user' , 'saller']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pulls');
    }
};
