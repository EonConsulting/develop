<?php

use Illuminate\Database\Seeder;

class SolutionLocationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_solution_location_type')->insert(
            [
                'description' => 'Storyline',
                'sequence' =>  4
            ],
            [
                'description' => 'Apps repository',
                'sequence' =>  2
            ],
            [
                'description' => 'Lecturer Interface',
                'sequence' => 3
            ],
            [
                'description' => 'Student Interface',
                'sequence' => 5
            ],
            [
                'description' => 'Administrator Interface',
                'sequence' => 1
            ]
        );
    }
}
