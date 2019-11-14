<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessagesTable extends Migration {

	public function up()
	{
		Schema::create('messages', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 191);
			$table->string('email', 191);
			$table->string('phone', 191);
			$table->string('subject', 191);
			$table->text('content');
		});
	}

	public function down()
	{
		Schema::drop('messages');
	}
}