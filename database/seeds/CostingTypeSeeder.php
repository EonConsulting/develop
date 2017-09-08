<?php

use Illuminate\Database\Seeder;

class CostingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_costing_type')->insert(
            [
                'description' => 'Free',
                'sequence' => 1
            ],
            [
                'description' => 'Subscription',
                'sequence' => 3
            ],
            [
                'description' => 'License Fee',
                'sequence' => 2
            ]
        );
    }
}
