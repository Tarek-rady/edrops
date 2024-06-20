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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code');
            $table->foreignId('admin_id')->nullable()->references('id')->on('admins')->cascadeOnDelete();
            $table->foreignId('saller_id')->nullable()->references('id')->on('sallers')->cascadeOnDelete();
            $table->foreignId('status_id')->nullable()->references('id')->on('statuses')->cascadeOnDelete();
            $table->string('customer_name');
            $table->string('country');
            $table->string('city');
            $table->string('country_code');
            $table->string('phone');
            $table->string('website')->nullable();
            $table->text('address');
            $table->text('notes')->nullable();
            $table->integer('code');
            $table->decimal('total_products_cost' , 8 , 2)->nullable();
            $table->decimal('shipping_tax' , 8 , 2)->default(0.0);
            $table->decimal('customer_total_cost' , 8 , 2)->nullable();
            $table->decimal('service_cost' , 8 , 2)->default(0.0);
            $table->decimal('saller_total_profit' , 8 , 2)->nullable();

            $table->enum('type' , ['cart' , 'order']);
            $table->enum('payment_method' , ['cash'  , 'wallet' ])->default('cash');

            $table->timestamp('date_order')->nullable(); // 'تم الطلب'
            $table->timestamp('date_progress')->nullable();  // 'جاري المعالجه'
            $table->timestamp('date_processing')->nullable();  // 'جاري التنفيذ'
            $table->timestamp('date_done')->nullable();  // 'تم التنفيذ'
            $table->timestamp('date_delivery')->nullable();  // 'جاري التوصيل'
            $table->timestamp('date_complete')->nullable();  //  'مكتمل'
            $table->timestamp('date_canceled')->nullable();  //  'مكتمل'

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
