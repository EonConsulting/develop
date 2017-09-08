<?php

use Illuminate\Database\Seeder;

class SchoolTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_school_type')->insert(
            [
                'description' => 'School of Accountancy',
                'sequence' => 1
            ],
            [
                'description' => 'School of Applied Accountancy',
                'sequence' => 3
            ],
            [
                'description' => 'School of Agriculture and Life Sciences',
                'sequence' => 2
            ],
            [
                'description' => 'School of Environmental Sciences',
                'sequence' => 6
            ],
            [
                'description' => 'School of Educational Studies',
                'sequence' => 5
            ],
            [
                'description' => 'School of Teacher Education',
                'sequence' => 10
            ],
            [
                'description' => 'School of Arts',
                'sequence' => 4
            ],
            [
                'description' => 'School of Humanities',
                'sequence' => 7
            ],
            [
                'description' => 'School of Social Sciences',
                'sequence' => 9
            ],
            [
                'description' => 'School of Interdisciplinary Research and Graduate Studies (SIRGS)',
                'sequence' => 8
            ]
        );
    }
}
