<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('username', 191);
			$table->string('email', 191)->unique();
			$table->date('date_of_birth');
			$table->integer('blood_type_id')->unsigned();
			$table->date('last_donation')->nullable();
			$table->integer('city_id')->unsigned();
			$table->string('phone', 191);
			$table->string('password', 191);
			$table->string('pin_code', 191)->nullable();
			$table->string('api_token', 60)->unique()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
