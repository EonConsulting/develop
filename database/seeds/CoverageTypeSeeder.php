<?php

use Illuminate\Database\Seeder;

class CoverageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_coverage_type')->insert(
            [
                'description' => 'Spacial Topic - Geometry (Where)',
                'sequence' => 1
            ],
            [
                'description' => 'Temporal Topic - Synchronization (When)',
                'sequence' => 2
            ]
        );
    }
}
