<?php

use Illuminate\Database\Seeder;

class PedagogicalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_pedagogical_type')->insert(
            [
                'description' => 'Outcome Based',
                'sequence' => 2
            ],
            [
                'description' => 'Schedule Based',
                'sequence' => 3
            ],
            [
                'description' => 'Content Based',
                'sequence' => 1
            ]
        );
    }
}
