<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('personal_profiles', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('user_id');
          $table->string('title')->nullable();
          $table->string('first_name');
          $table->string('middle_name')->nullable();
          $table->string('last_name');
          $table->string('nick_name')->nullable();
          $table->string('picture')->nullable();
          $table->unsignedInteger('permanent_address_id');
          $table->unsignedInteger('residence_address_id');
          $table->date("dob");
          $table->char('gender', 1);
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
        Schema::dropIfExists('personal_profiles');
    }
}
