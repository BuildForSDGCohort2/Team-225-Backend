<?php

use Illuminate\Database\Seeder;
use App\Hotel;

class HotelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //inserting fake data
        $faker = \Faker\Factory::create();
        for ($i=0; $i < 10 ; $i++) { 
        	Hotel::create([
        		'hotel_name' => $faker->sentence,
        		'description' => $faker->paragraph,
        		'price' => 100
        	]);
        }
    }
}
