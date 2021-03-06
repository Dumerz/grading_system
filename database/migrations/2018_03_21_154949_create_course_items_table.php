<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courseitems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->integer('course');
            $table->foreign('course')->references('id')->on('courses')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('period');
            $table->foreign('period')->references('id')->on('courseperiods')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('scheme');
            $table->foreign('scheme')->references('id')->on('courseschemes')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('max_score');
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
        Schema::table('courseitems', function ($table) {
            $table->dropForeign(['course']);
            $table->dropForeign(['period']);
            $table->dropForeign(['scheme']);
        });
        Schema::dropIfExists('courseitems');
    }
}
