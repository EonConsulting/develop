<?php

use Illuminate\Database\Seeder;

class StudyCycleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_study_type')->insert(
            [
                'description' => 'Application',
                'sequence' => 2
            ],
            [
                'description' => 'Admittance',
                'sequence' => 1
            ],
            [
                'description' => 'Registration',
                'sequence' => 5
            ],
            [
                'description' => 'Study',
                'sequence' => 6
            ],
            [
                'description' => 'Examination',
                'sequence' => 3
            ],
            [
                'description' => 'Graduation',
                'sequence' => 4
            ]
        );
    }
}
