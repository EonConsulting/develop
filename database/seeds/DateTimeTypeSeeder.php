<?php

use Illuminate\Database\Seeder;

class DateTimeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_date_time_type')->insert(
            [
                'description' => 'Date Time Stamp',
                'sequence' => 1
            ]
        );
    }
}
