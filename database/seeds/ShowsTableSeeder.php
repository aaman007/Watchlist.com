<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ShowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Show');

        for($i=0;$i<100;$i++)
        {
            DB::table('shows')->insert([
                'name' => $faker->name,
                'cover_image' => 'nocover.jpg',
                'plot' => implode($faker->paragraphs(10)),
                'episodes' => $faker->randomNumber(3),
                'rating' => 0,
                'premiere_date' => \Carbon\Carbon::now(),
                'status' => $faker->randomElement(['Airing','Not Aired','Finished']),
                'watch_count' => 0,
                'rating_count' => 0,
                'category' => $faker->randomElement(['Anime','TV','Hollywood','Bollywood']),
                'user_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
