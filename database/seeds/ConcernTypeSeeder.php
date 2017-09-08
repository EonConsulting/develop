<?php

use Illuminate\Database\Seeder;

class ConcernTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_concern_type')->insert(
            [
                'description' => 'Reliability',
                'sequence' => 2
            ],
            [
                'description' => 'Usability',
                'sequence' => 1
            ],
            [
                'description' => 'Responsiveness',
                'sequence' => 3
            ],
            [
                'description' => 'Security',
                'sequence' => 4
            ]
        );
    }
}
