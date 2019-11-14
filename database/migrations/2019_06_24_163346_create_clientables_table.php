<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientablesTable extends Migration {

	public function up()
	{
		Schema::create('clientables', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('client_id');
			$table->integer('clientable_id');
			$table->string('clientable_type', 191);
			$table->boolean('is_read')->default(0);
		});
	}

	public function down()
	{
		Schema::drop('clientables');
	}
}