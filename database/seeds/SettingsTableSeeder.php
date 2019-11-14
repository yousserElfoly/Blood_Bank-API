<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = \App\Setting::create([
            'title' 	=> 'دكتور',
            'logo' 		=> 'doctor.png',
            'about_us'  => 'دكتور',
            'phone' 	=> '07775000',
            'email'     => 'email@app.com',
            'facebook_url'  => 'https://www.facebook.com/',
            'twitter_url'   => 'https://twitter.com',
            'instagram_url' => 'https://www.instagram.com/',
            'youtube_url' => 'https://www.youtube.com/',
        ]);
    }
}
