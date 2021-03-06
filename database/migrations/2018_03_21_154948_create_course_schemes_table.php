<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseSchemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courseschemes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->integer('course');
            $table->foreign('course')->references('id')->on('courses')->onUpdate('cascade')->onDelete('restrict');
            $table->decimal('amount', 8, 2);
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
        Schema::table('courseperiods', function ($table) {
            $table->dropForeign(['course']);
        });
        Schema::dropIfExists('courseschemes');
    }
}
