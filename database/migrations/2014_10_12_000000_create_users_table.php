<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('company')->nullable();
            $table->string('email')->unique();
            $table->string('uuid')->unique();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('office')->nullable();
            $table->string('address')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('zipCode')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->enum('role',['user','admin'])->default('user');
            $table->boolean('gender')->nullable();
            $table->boolean('active')->default(false);
            $table->boolean('disableLogin')->default(false);
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
