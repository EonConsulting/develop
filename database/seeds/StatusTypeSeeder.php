<?php

use Illuminate\Database\Seeder;

class StatusTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_status_type')->insert(
            [
                'description' => 'Potential student',
                'sequence' => 2
            ],
            [
                'description' => 'Registered student',
                'sequence' => 3
            ],
            [
                'description' => 'Alumni',
                'sequence' => 1
            ]
        );
    }
}
