<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseStudentEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coursestudentevaluations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_item');
            $table->foreign('course_item')->references('id')->on('courseitems')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('course_student');
            $table->foreign('course_student')->references('id')->on('coursestudents')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('score');
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
        Schema::table('coursestudentevaluations', function ($table) {
            $table->dropForeign(['course_item']);
            $table->dropForeign(['course_student']);
        });
        Schema::dropIfExists('coursestudentevaluations');
    }
}
