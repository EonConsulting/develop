<?php

use Illuminate\Database\Seeder;

class CollegeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_college_type')->insert(
            [
                'description' => 'Accounting Sciences',
                'sequence' => 1
            ],
            [
                'description' => 'Agriculture and Environmental Sciences',
                'sequence' => 2
            ],
            [
                'description' => 'Economic and Management Sciences',
                'sequence' => 3
            ],
            [
                'description' => 'Education',
                'sequence' => 4
            ],
            [
                'description' => 'Human Sciences',
                'sequence' => 6
            ],
            [
                'description' => 'Law',
                'sequence' => 7
            ],
            [
                'description' => 'Science, Engineering and Technology',
                'sequence' => 8
            ],
            [
                'description' => 'Graduate Studies',
                'sequence' => 5
            ]
        );
    }
}
