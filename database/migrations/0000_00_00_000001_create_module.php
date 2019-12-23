<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module', function (Blueprint $table) {
            $table->increments('modid');
            $table->unsignedInteger('module_category_id');
            $table->integer('parent_id')->nullable();
            $table->string('mod_name');
            $table->string('mod_alias');
            $table->string('mod_icon');
            $table->string('permalink');
            $table->integer('mod_order');
            $table->timestamps();
            $table->foreign('module_category_id')->references('id')->on('module_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module');
    }
}
