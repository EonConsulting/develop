<?php

use Illuminate\Database\Seeder;

class ChairTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_chair_type')->insert(
            [
                'description' => 'South African Research Chair in Development Education',
                'sequence' => 1
            ],
            [
                'description' => 'South African Research Chair in Social Policy',
                'sequence' => 2
            ],
            [
                'description' => 'Unesco - Unisa Africa Chair in nanoscience and nanotechnology',
                'sequence' => 3
            ]
        );
    }
}
