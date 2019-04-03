<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('nameEn')->nullable();
            $table->integer('type')->default(0);
            $table->string('email')->unique()->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('locationable_type')->nullable();
            $table->integer('locationable_id')->nullable();
            $table->integer('designation_id')->nullable();
            $table->string('password');
            $table->tinyInteger('status')->default(1);
            $table->string('mobile')->nullable();
            $table->string('avatar')->nullable();
            
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
