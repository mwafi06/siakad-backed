<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('uid');
            $table->unsignedInteger('lessons_id');
            $table->timestamps();
            $table->foreign('lessons_id')->references('id')->on('lessons');
            $table->foreign('uid')->references('uid')->on('employee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher');
    }
}
