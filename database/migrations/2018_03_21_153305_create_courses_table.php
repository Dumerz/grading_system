<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('description');
            $table->integer('evaluator');
            $table->foreign('evaluator')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->string('status');
            $table->foreign('status')->references('coursestatus_id')->on('coursestatus')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::table('courses', function ($table) {
            $table->dropForeign(['evaluator']);
            $table->dropForeign(['status']);
        });
        Schema::dropIfExists('courses');
    }
}
