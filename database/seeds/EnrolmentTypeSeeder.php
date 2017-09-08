<?php

use Illuminate\Database\Seeder;

class EnrolmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_enrolment_type')->insert(
            [
                'description' => 'Full-time',
                'sequence' => 1
            ],
            [
                'description' => 'Part-time',
                'sequence' => 2
            ]
        );
    }
}
