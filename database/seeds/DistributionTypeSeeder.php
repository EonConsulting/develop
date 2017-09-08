<?php

use Illuminate\Database\Seeder;

class DistributionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_distribution_type')->insert(
            [
                'description' => 'On campus',
                'sequence' => 2
            ],
            [
                'description' => 'Correspondence',
                'sequence' => 3
            ],
            [
                'description' => 'Online',
                'sequence' => 1
            ]
        );
    }
}
