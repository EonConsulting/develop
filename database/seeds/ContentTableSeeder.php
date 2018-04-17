<?php

use Illuminate\Database\Seeder;
use EONConsulting\ContentBuilder\Models\Content;
use EONConsulting\ContentBuilder\Models\Category;

class ContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i=0; $i<10;$i++)
        {

            $content = new Content([
                'title' => $faker->sentence(5),
                'body' => $faker->realText($faker->numberBetween(1000,5000)),
                'tags' => implode(",", explode(" ", $faker->sentence(5))),
                'creator_id' => 1,
                'description' => $faker->realText($faker->numberBetween(10,100)),
            ]);

            $content->save();

            $categories = Category::all()->random(4);

            $content->categories()->sync($categories);

            echo "DONE!!\n";
        }
    }
}
