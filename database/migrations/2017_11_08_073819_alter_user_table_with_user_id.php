<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserTableWithUserId extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_id', 24)->unique()->nullable();
        });

        $users = DB::table('users')->get();
        foreach ($users as $user) {
          DB::table('users')->where('id', $user->id)->update(['user_id' => unique_user_id()]);
        }

        Schema::table('users', function (Blueprint $table) {
            $table->string('user_id')->nullable(false)->change();
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
            $table->dropColumn("user_id");
        });
    }
}
