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
        Schema::create('payout_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('saller_id')->nullable()->references('id')->on('sallers')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->cascadeOnDelete();
            $table->decimal('amount' , 8 , 2);
            $table->enum('method' , ['bank','wallet', 'western_union']);
            $table->enum('status' , ['waiting' , 'accept' , 'rejection']);
            $table->string('account_holder_name')->nullable();
            $table->string('iban')->nullable();
            $table->string('swift_code')->nullable();
            $table->foreignId('wallet_name')->nullable()->references('id')->on('country_cashes')->cascadeOnDelete();
            $table->string('wallet_no')->nullable();
            $table->string('english_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->text('notes')->nullable();
            $table->enum('type' , ['user' , 'saller']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payout_requests');
    }
};
