<?php

use Illuminate\Database\Seeder;

class InterestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_interest_type')->insert(
            [
                'description' => 'Course',
                'sequence' => 2
            ],
            [
                'description' => 'Module',
                'sequence' => 4
            ],
            [
                'description' => 'Subject',
                'sequence' => 5
            ],
            [
                'description' => 'Topic',
                'sequence' => 6
            ],
            [
                'description' => 'Idea',
                'sequence' => 3
            ],
            [
                'description' => 'Asset',
                'sequence' => 1
            ]
        );
    }
}
