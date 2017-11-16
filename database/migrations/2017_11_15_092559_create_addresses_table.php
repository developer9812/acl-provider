<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('addresses', function (Blueprint $table) {
          $table->increments('id');
          $table->string('block_no')->nullable();
          $table->string('building')->nullable();
          $table->string('landmark')->nullable();
          $table->string('street');
          $table->string('city');
          $table->string('subdistrict')->nullable();
          $table->string('district');
          $table->string('district_iso');
          $table->string('state');
          $table->string('state_iso');
          $table->string('country');
          $table->string('country_iso')->nullable();
          $table->string('pincode');
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
        Schema::dropIfExists('addresses');
    }
}
