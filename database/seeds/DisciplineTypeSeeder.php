<?php

use Illuminate\Database\Seeder;

class DisciplineTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_discipline_type')->insert(
            [
                'classification' => "arts",
                'description' => 'Performing Arts',
                'sequence' => 1
            ],
            [
                'classification' => 'arts',
                'description' => 'Visual Arts',
                'sequence' => 2
            ]
        );
    }
}
