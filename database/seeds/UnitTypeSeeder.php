<?php

use Illuminate\Database\Seeder;

class UnitTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_unit_type')->insert(
            [
                'description' => 'Applied Behavioural Ecology and Ecosystem Research Unit',
                'sequence' => 3
            ],
            [
                'description' => 'Anthropology and Archaeology Museum',
                'sequence' => 2
            ],
            [
                'description' => 'African Languages Literary Information Museum',
                'sequence' => 1
            ],
            [
                'description' => 'Unisa Art Gallery',
                'sequence' => 4
            ],
            [
                'description' => 'Unisa Law Clinic',
                'sequence' => 5
            ]
        );
    }
}
