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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->references('id')->on('products')->cascadeOnDelete();
            $table->foreignId('saller_id')->nullable()->references('id')->on('sallers')->cascadeOnDelete();
            $table->foreignId('admin_id')->nullable()->references('id')->on('admins')->cascadeOnDelete();
            $table->foreignId('country_id')->nullable()->references('id')->on('countries')->cascadeOnDelete();
            $table->double('rate');
            $table->longText('msg');
            $table->string('user_name')->nullable();
            $table->enum('type' , ['products' , 'sallers' , 'users']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
