<?php

use Illuminate\Database\Seeder;

class RiskTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_risk_type')->insert(
            [
                'description' => 'System',
                'sequence' => 3
            ],
            [
                'description' => 'Integration',
                'sequence' => 2
            ],
            [
                'description' => '3rd Party Components',
                'sequence' => 1
            ]
        );
    }
}
