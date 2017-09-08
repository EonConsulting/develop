<?php

use Illuminate\Database\Seeder;

class PhysicalLocationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_physical_location_type')->insert(
            [
                'description' => 'Physical Address',
                'sequence' => 2
            ],
            [
                'description' => 'GPS Coordinates',
                'sequence' => 1
            ]
        );
    }
}
