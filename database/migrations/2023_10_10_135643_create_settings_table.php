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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('instagram')->nullable();
            $table->string('wattsapp')->nullable();
            $table->string('phone')->nullable();
            $table->double('lat')->nullable()->default(0);
            $table->double('lng')->nullable()->default(0);
            $table->string('location')->nullable();
            $table->string('email')->nullable();
            $table->string('gmail')->nullable();
            $table->text('desc_ar')->nullable();
            $table->text('desc_en')->nullable();
            $table->integer('profit_app')->nullable();
            $table->integer('profit_saller')->nullable();
            $table->integer('min')->nullable();
            $table->integer('max')->nullable();
            $table->string('type')->nullable();
            $table->integer('bronze')->default(0);
            $table->integer('silver')->default(0);
            $table->integer('gold')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
