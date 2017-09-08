<?php

use Illuminate\Database\Seeder;

class ApplicationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_application_type')->insert(
            [
                'description' => 'Self-Study',
                'sequence' => 2
            ],
            [
                'description' => 'Course based',
                'sequence' => 1
            ]
        );
    }
}
