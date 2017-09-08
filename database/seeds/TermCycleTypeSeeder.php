<?php

use Illuminate\Database\Seeder;

class TermCycleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_term_cycle_type')->insert(
            [
                'description' => '1st Term',
                'sequence' => 1
            ],
            [
                'description' => '2nd Term',
                'sequence' => 2
            ],
            [
                'description' => '3rd Term',
                'sequence' => 3
            ],
            [
                'description' => '4th Term',
                'sequence' => 4
            ]
        );
    }
}
