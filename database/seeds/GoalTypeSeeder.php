<?php

use Illuminate\Database\Seeder;

class GoalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_goal_type')->insert(
            [
                'description' => 'Professional Qualification',
                'sequence' => 3
            ],
            [
                'description' => 'Certification',
                'sequence' => 2
            ],
            [
                'description' => 'Continued Education',
                'sequence' => 1
            ],
            [
                'description' => 'Research',
                'sequence' => 4
            ],
            [
                'description' => 'Professional Registration ',
                'sequence' => 5
            ]
        );
    }
}
