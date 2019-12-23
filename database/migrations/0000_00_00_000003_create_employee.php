<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->increments('uid');
            $table->unsignedInteger('guid');
            $table->string('nip')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('full_name');
            $table->date('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('pin',6)->nullable();
            $table->enum('pin_login',array('y','n'))->default('n');
            $table->enum('is_teacher',array('y','n'))->default('n');
            $table->enum('active',array('y','n'))->default('y');
            $table->enum('login',array('y','n'))->default('n');
            $table->string('login_token',50)->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('guid')->references('guid')->on('employee_group');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee');
    }
}
