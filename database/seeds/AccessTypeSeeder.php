<?php

use Illuminate\Database\Seeder;

class AccessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_access_type')->insert(
            [
                'description' => 'Internal Use',
                'sequence' => 1
            ],
            [
                'description' => 'Open to public',
                'sequence' => 2
            ]
        );
    }
}
