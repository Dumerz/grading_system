<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('name_first');
            $table->string('name_middle')->nullable();
            $table->string('name_last');
            $table->string('name_suffix')->nullable();
            $table->enum('gender', ["MALE", "FEMALE"]);
            $table->timestamp('date_birth');
            $table->string('status')->default('USRSTAT001');
            $table->string('usertype')->default('USRTYPE001');
            $table->foreign('usertype')->references('usertype_id')->on('usertypes')->onUpdate('cascade');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
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
        Schema::table('users', function ($table) {
            $table->dropForeign(['usertype']);
        });
        Schema::dropIfExists('users');
    }
}
