<?php

use Illuminate\Database\Seeder;

class ExpirationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_expiration_type')->insert(
            [
                'description' => 'Time Cycle',
                'sequence' => 2
            ],
            [
                'description' => 'Event',
                'sequence' => 1
            ]
        );
    }
}
