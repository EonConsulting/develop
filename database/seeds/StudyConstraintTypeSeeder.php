<?php

use Illuminate\Database\Seeder;

class StudyConstraintTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_study_constraint_type')->insert(
            [
                'description' => 'Time',
                'sequence' => 3
            ],
            [
                'description' => 'Money',
                'sequence' => 1
            ],
            [
                'description' => 'Technology',
                'sequence' => 2
            ]
        );
    }
}
