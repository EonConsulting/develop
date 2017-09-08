<?php

use Illuminate\Database\Seeder;

class InstituteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_institute_type')->insert(
            [
                'description' => 'Institute of Gender Studies',
                'sequence' => 4
            ],
            [
                'description' => 'Research Institute for Theology and Religion',
                'sequence' => 8
            ],
            [
                'description' => 'WIPHOLD-Brigalia Ban Chair in Electoral Democracy in Africa',
                'sequence' => 9
            ],
            [
                'description' => 'Institute for Dispute Resolution in Africa (IDRA)',
                'sequence' => 3
            ],
            [
                'description' => 'Archie Mafeje Research Institute (AMRI)',
                'sequence' => 1
            ],
            [
                'description' => 'Institute for African Renaissance Studies (IARS)',
                'sequence' => 2
            ],
            [
                'description' => 'Institute for Open and Distance Learning (IODL)',
                'sequence' => 5
            ],
            [
                'description' => 'Institute for Science and Technology Education (ISTE)',
                'sequence' => 6
            ],
            [
                'description' => 'Institute for Social and Health Studies (ISHS)',
                'sequence' => 7
            ]
        );
    }
}
