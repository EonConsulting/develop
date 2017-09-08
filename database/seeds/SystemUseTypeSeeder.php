<?php

use Illuminate\Database\Seeder;

class SystemUseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_system_use_type')->insert(
            [
                'description' => 'Front end use',
                'sequence' => 2
            ],
            [
                'description' => 'Back end use',
                'sequence' => 1
            ]
        );
    }
}
