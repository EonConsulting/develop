<?php

use Illuminate\Database\Seeder;

class LicenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_license_type')->insert(
            [
                'description' => 'OSI approved Open Source',
                'sequence' => 3
            ],
            [
                'description' => 'Public Domain',
                'sequence' => 4
            ],
            [
                'description' => 'Creative Commons Attribution',
                'sequence' => 2
            ],
            [
                'description' => 'Commercial',
                'sequence' => 1
            ],
            [
                'description' => 'Unisa specific',
                'sequence' => 5
            ]
        );
    }
}
