<?php

use Illuminate\Database\Seeder;

class QualificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_qualification_type')->insert(
            [
                'description' => 'Certificate',
                'sequence' => 1
            ],
            [
                'description' => 'Diploma',
                'sequence' => 3
            ],
            [
                'description' => 'Degree',
                'sequence' => 2
            ],
            [
                'description' => 'Honours Degree',
                'sequence' => 5
            ],
            [
                'description' => 'Masters Degree',
                'sequence' => 6
            ],
            [
                'description' => 'Doctoral Degree',
                'sequence' => 4
            ]
        );
    }
}
