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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('admin_id')->nullable()->references('id')->on('admins')->cascadeOnDelete();
            $table->foreignId('country_id')->references('id')->on('countries')->cascadeOnDelete();
            $table->string('sku');
            $table->decimal('cost_user',8,2)->nullable();
            $table->decimal('cost',8,2)->nullable();
            $table->decimal('price',8,2)->nullable();
            $table->decimal('profit',8,2)->nullable();
            $table->integer('qty');
            $table->string('amazon')->nullable();
            $table->string('youtube')->nullable();
            $table->integer('stock');
            $table->longText('desc_ar');
            $table->longText('desc_en');
            $table->longText('use_product_ar');
            $table->longText('use_product_en');
            $table->longText('note_ar');
            $table->longText('note_en');
            $table->longText('populer_ar');
            $table->longText('populer_en');
            $table->longText('adv_ar');
            $table->longText('adv_en');
            $table->string('img');
            $table->foreignId('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->foreignId('stock_id')->references('id')->on('stocks')->cascadeOnDelete();
            $table->foreignId('brand_id')->nullable()->references('id')->on('categories')->cascadeOnDelete();
            $table->decimal('discount' , 8 , 2)->nullable();
            $table->integer('viewer')->default(0);
            $table->string('video')->nullable();
            $table->boolean('is_active')->default(0);
            $table->integer('ratio')->default(0);
            $table->integer('delivery')->default(0);
            $table->integer('competition')->default(0);
            $table->decimal('min',8,2)->nullable();
            $table->decimal('max',8,2)->nullable();
            $table->enum('type' , ['public' , 'private']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
