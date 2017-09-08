<?php

use Illuminate\Database\Seeder;

class RatingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_rating_type')->insert(
            [
                'classification' => 'Popularity',
                'description' => 'Always',
                'sequence' => 1
            ],
            [
                'classification' => 'Popularity',
                'description' => 'Often',
                'sequence' => 3
            ],
            [
                'classification' => 'Popularity',
                'description' => 'Sometimes',
                'sequence' => 5
            ],
            [
                'classification' => 'Popularity',
                'description' => 'Rarely',
                'sequence' => 4
            ],
            [
                'classification' => 'Popularity',
                'description' => 'Never',
                'sequence' => 2
            ]
        );
    }
}
