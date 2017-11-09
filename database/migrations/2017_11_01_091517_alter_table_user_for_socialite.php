<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUserForSocialite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->string('email')->nullable()->change();
          $table->string('password', 60)->nullable()->change();
          $table->string('provider');
          $table->string('provider_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->removeColumn('provider');
          $table->removeColumn('provider_id');
          $table->string('email')->nullable(false)->change();
          $table->string('password', 60)->nullable(false)->change();
        });
    }
}
