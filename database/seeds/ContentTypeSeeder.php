<?php

use Illuminate\Database\Seeder;

class ContentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_content_type')->insert(
            [
                'description' => 'Learning Content',
                'sequence' => 3
            ],
            [
                'description' => 'Learning Outcomes',
                'sequence' => 4
            ],
            [
                'description' => 'Lecturers voice',
                'sequence' => 5
            ],
            [
                'description' => 'Assessments',
                'sequence' => 1
            ],
            [
                'description' => 'Multimedia',
                'sequence' => 6
            ],
            [
                'description' => 'Textbooks',
                'sequence' => 8
            ],
            [
                'description' => 'Web 2.0',
                'sequence' => 9
            ],
            [
                'description' => 'Feedback',
                'sequence' => 2
            ],
            [
                'description' => 'Reminders',
                'sequence' => 7
            ]
        );
    }
}
