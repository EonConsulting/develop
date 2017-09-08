<?php

use Illuminate\Database\Seeder;

class RoleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_role_type')->insert(
            [
                'description' => 'Student',
                'sequence' => 8
            ],
            [
                'description' => 'Lecturer',
                'sequence' => 5
            ],
            [
                'description' => 'Tutor',
                'sequence' => 10
            ],
            [
                'description' => 'Administrator',
                'sequence' => 1
            ],
            [
                'description' => 'Proctor',
                'sequence' => 7
            ],
            [
                'description' => 'Facilitator',
                'sequence' => 4
            ],
            [
                'description' => 'Assistant',
                'sequence' => 2
            ],
            [
                'description' => 'Editor',
                'sequence' => 3
            ],
            [
                'description' => 'Moderator',
                'sequence' => 6
            ],
            [
                'description' => 'Subject Matter Expert',
                'sequence' => 9
            ]
        );
    }
}
