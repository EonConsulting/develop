<?php

use Illuminate\Database\Seeder;

class DurationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_duration_type')->insert(
            [
                'description' => 'Course Duration',
                'sequence' => 2
            ],
            [
                'description' => 'Evaluation Duration',
                'sequence' => 3
            ],
            [
                'description' => 'Certification Duration',
                'sequence' => 1
            ],
            [
                'description' => 'Study Duration',
                'sequence' => 5
            ],
            [
                'description' => 'Online Interaction Duration',
                'sequence' => 4
            ]
        );
    }
}
