<?php

use Illuminate\Database\Seeder;

class ContentTagTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_content_tag_type')->insert(
            [
                'description' => 'Question',
                'sequence' => 4
            ],
            [
                'description' => 'Important',
                'sequence' => 3
            ],
            [
                'description' => 'Fact',
                'sequence' => 1
            ],
            [
                'description' => 'Remember',
                'sequence' => 6
            ],
            [
                'description' => 'Hint',
                'sequence' => 2
            ],
            [
                'description' => 'Reflection',
                'sequence' => 5
            ]
        );
    }
}
