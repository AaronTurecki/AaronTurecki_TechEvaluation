<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create(
            'users',
            function (Blueprint $table) {

                $table->increments('id');
                $table->string('firstname', 20);
                $table->string('url', 255);
                $table->string('code', 12);
                $table->timestamps();
            });
    }
    public function down()
    {
        Schema::drop('links');
    }
}
