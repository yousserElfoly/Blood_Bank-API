<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('full_name', 191);
			$table->integer('blood_type_id')->unsigned();
			$table->string('age', 191);
			$table->string('quantity', 191);
			$table->string('hospital_name', 191);
			$table->text('hospital_address');
			$table->decimal('latitude', 10,8)->nullable();
			$table->decimal('longitude', 10,8)->nullable();
			$table->integer('city_id')->unsigned();
			$table->string('phone', 191);
			$table->text('notes');
			$table->integer('client_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
