<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursestudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coursestudents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course');
            $table->foreign('course')->references('id')->on('courses')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('student');
            $table->foreign('student')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('status');
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
        Schema::table('coursestudents', function ($table) {
            $table->dropForeign(['course']);
            $table->dropForeign(['student']);
        });
        Schema::dropIfExists('coursestudents');
    }
}
