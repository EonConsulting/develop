<?php

use Illuminate\Database\Seeder;

class CentreTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_centre_type')->insert(
            [
                'description' => 'Centre for Accounting Studies',
                'sequence' => 1
            ],
            [
                'description' => 'Centre for Sustainable Agriculture and Environmental Sciences',
                'sequence' => 2
            ],
            [
                'description' => 'Centre for Business Management',
                'sequence' => 3
            ],
            [
                'description' => 'Centre for Decision Sciences',
                'sequence' => 4
            ],
            [
                'description' => 'Centre for Transport Economics, Logistics and Tourism',
                'sequence' => 5
            ],
            [
                'description' => 'Centre for Continuing Education and Training',
                'sequence' => 6
            ],
            [
                'description' => 'Centre for Applied Information and Communication',
                'sequence' => 7
            ],

            [
                'description' => 'Centre for Applied Psychology',
                'sequence' => 8
            ],
            [
                'description' => 'Centre for Pan African Languages and Cultural Development',
                'sequence' => 9
            ],
            [
                'description' => 'Khanokhulu Centre',
                'sequence' => 10
            ],
            [
                'description' => 'The John Povey Centre for the Study of English in Southern Africa',
                'sequence' => 11
            ],
            [
                'description' => 'Tirisano Centre',
                'sequence' => 12
            ],
            [
                'description' => 'Centre for Basic Legal Education',
                'sequence' => 13
            ],
            [
                'description' => 'Centre for Business Law',
                'sequence' => 14
            ],
            [
                'description' => 'Centre for Criminological Sciences',
                'sequence' => 15
            ],
            [
                'description' => 'Centre for Foreign and Comparative Law',
                'sequence' => 16
            ],
            [
                'description' => 'Centre for Public Law Studies',
                'sequence' => 17
            ],
            [
                'description' => 'Centre for Software Engineering (CENSE)',
                'sequence' => 18
            ],
            [
                'description' => 'Centre for Industrial and Organisational Psychology',
                'sequence' => 19
            ]
        );
    }
}
