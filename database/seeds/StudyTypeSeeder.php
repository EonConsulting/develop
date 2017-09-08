<?php

use Illuminate\Database\Seeder;

class StudyTypeSeeder extends Seeder
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
                'description' => 'Revision',
                'sequence' => 3
            ],
            [
                'description' => '1st registration',
                'sequence' => 1
            ],
            [
                'description' => 'Repeat Student',
                'sequence' => 2
            ]
        );
    }
}
