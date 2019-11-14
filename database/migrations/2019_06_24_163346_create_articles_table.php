<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration {

	public function up()
	{
		Schema::create('articles', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 191);
			$table->string('image', 191);
			$table->text('content');
			$table->integer('category_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('articles');
	}
}