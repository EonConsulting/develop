<?php

use Illuminate\Database\Seeder;

class StudentCycleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_student_cycle_type')->insert(
            [
                'description' => 'Undergraduate',
                'sequence' => 3
            ],
            [
                'description' => 'Graduate',
                'sequence' => 1
            ],
            [
                'description' => 'Postgraduate',
                'sequence' => 2
            ]
        );
    }
}
