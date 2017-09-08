<?php

use Illuminate\Database\Seeder;

class CollaborationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_collaboration_type')->insert(
            [
                'description' => 'Student-to-student',
                'sequence' => 7
            ],
            [
                'description' => 'Student-to-lecturer',
                'sequence' => 6
            ],
            [
                'description' => 'Student-to-group',
                'sequence' => 5
            ],
            [
                'description' => 'Student-to-content',
                'sequence' => 4
            ],
            [
                'description' => 'Lecturer-to-lecturer',
                'sequence' => 3
            ],
            [
                'description' => 'Lecturer-to-group',
                'sequence' => 2
            ],
            [
                'description' => 'Lecturer-to-content',
                'sequence' => 1
            ]
        );
    }
}
