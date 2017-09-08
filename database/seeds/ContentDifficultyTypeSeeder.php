<?php

use Illuminate\Database\Seeder;

class ContentDifficultyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_content_difficulty_type')->insert(
            [
                'description' => 'Easy',
                'sequence' => 2
            ],
            [
                'description' => 'Moderate',
                'sequence' => 4
            ],
            [
                'description' => 'Extreme',
                'sequence' => 3
            ],
            [
                'description' => 'Difficult',
                'sequence' => 1
            ],
            [
                'description' => 'Strenuous',
                'sequence' => 5
            ]
        );
    }
}
