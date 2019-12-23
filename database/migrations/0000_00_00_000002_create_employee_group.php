<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_group', function (Blueprint $table) {
            $table->increments('guid');
            $table->string('name');
            $table->string('create')->nullable();
            $table->string('read')->nullable();
            $table->string('update')->nullable();
            $table->string('delete')->nullable();
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
        Schema::dropIfExists('employee_group');
    }
}
