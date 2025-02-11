<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{

    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('img')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->enum('type' , ['admin','saller']);
            $table->rememberToken();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_verify')->default(0);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
