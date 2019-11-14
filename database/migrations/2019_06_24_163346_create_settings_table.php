<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 191);
			$table->text('about_us');
			$table->string('logo', 191);
			$table->string('email', 191);
			$table->string('phone', 191);
			$table->string('facebook_url', 191);
			$table->string('twitter_url', 191);
			$table->string('youtube_url', 191);
			$table->string('instagram_url', 191);
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}