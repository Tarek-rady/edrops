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
        Schema::create('sallers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('img')->nullable();
            $table->string('logo')->nullable();
            $table->string('passport')->nullable();
            $table->foreignId('admin_id')->references('id')->on('admins')->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->foreignId('country_id')->references('id')->on('countries')->cascadeOnDelete();
            $table->foreignId('city_id')->references('id')->on('cities')->cascadeOnDelete();
            $table->foreignId('currency')->nullable()->references('id')->on('currencies')->cascadeOnDelete();
            $table->string('region');
            $table->string('address');
            $table->string('address_2')->nullable();
            $table->string('company')->nullable();
            $table->string('phone');
            $table->boolean('is_active')->default(1);
            $table->boolean('is_verify')->default(0);
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('shopify')->nullable();
            $table->decimal('amount')->default(0);
            $table->integer('point_num')->default(0);
            $table->foreignId('point_id')->nullable()->references('id')->on('points')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sallers');
    }
};
