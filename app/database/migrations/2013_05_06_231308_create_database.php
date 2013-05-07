<?php

use Illuminate\Database\Migrations\Migration;

class CreateDatabase extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
    {
		Schema::create('topics', function($table) {
            $table->increments('id');

            $table->string('topic');
            $table->string('slug');
            $table->text('body');
            $table->integer('user_id')->unsigned();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('replies', function($table) {
            $table->increments('id');

            $table->integer('topic_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('body');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('topic_id')->references('id')->on('topics');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('topics');
		Schema::drop('replies');
	}

}