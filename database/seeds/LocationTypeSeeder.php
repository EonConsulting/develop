<?php

use Illuminate\Database\Seeder;

class LocationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_location_type')->insert(
            [
                'description' => 'International students',
                'sequence' => 2
            ],
            [
                'description' => 'RSA students',
                'sequence' => 3
            ],
            [
                'description' => 'Location bound students',
                'sequence' => 1
            ]
        );
    }
}
