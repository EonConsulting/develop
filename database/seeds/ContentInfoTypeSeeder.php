<?php

use Illuminate\Database\Seeder;

class ContentInfoTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_content_info_type')->insert(
            [
                'description' => 'Name',
                'sequence' => 3
            ],
            [
                'description' => 'Description',
                'sequence' => 1
            ],
            [
                'description' => 'UID',
                'sequence' => 8
            ],
            [
                'description' => 'Required',
                'sequence' => 5
            ],
            [
                'description' => 'PID',
                'sequence' => 4
            ],
            [
                'description' => 'Version',
                'sequence' => 9
            ],
            [
                'description' => 'Format',
                'sequence' => 2
            ],
            [
                'description' => 'Source',
                'sequence' => 6
            ],
            [
                'description' => 'Title',
                'sequence' => 7
            ]
        );
    }
}
