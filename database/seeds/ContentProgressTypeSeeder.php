<?php

use Illuminate\Database\Seeder;

class ContentProgressTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_content_progress_type')->insert(
            [
                'description' => 'No Progress',
                'sequence' => 3
            ],
            [
                'description' => 'Some Progress',
                'sequence' => 4
            ],
            [
                'description' => 'Much Progress',
                'sequence' => 2
            ],
            [
                'description' => 'Excellent Progress',
                'sequence' => 1
            ]
        );
    }
}
