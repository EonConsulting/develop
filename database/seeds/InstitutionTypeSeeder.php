<?php

use Illuminate\Database\Seeder;

class InstitutionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_institution_type')->insert(
            [
                'description' => 'Faculty',
                'sequence' => 4
            ],
            [
                'description' => 'School',
                'sequence' => 6
            ],
            [
                'description' => 'Department',
                'sequence' => 3
            ],
            [
                'description' => 'College',
                'sequence' => 2
            ],
            [
                'description' => 'Academy',
                'sequence' => 1
            ],
            [
                'description' => 'Institute',
                'sequence' => 5
            ]
        );
    }
}
