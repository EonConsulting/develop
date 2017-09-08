<?php

use Illuminate\Database\Seeder;

class ProfileTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_profile_type')->insert(
            [
                'description' => 'Language',
                'sequence' => 4
            ],
            [
                'description' => 'Ethnicity',
                'sequence' => 3
            ],
            [
                'description' => 'Race',
                'sequence' => 6
            ],
            [
                'description' => 'Sex',
                'sequence' => 7
            ],
            [
                'description' => 'Date-of-birth',
                'sequence' => 2
            ],
            [
                'description' => 'Autonomous',
                'sequence' => 1
            ],
            [
                'description' => 'Nationality',
                'sequence' => 5
            ]
        );
    }
}
