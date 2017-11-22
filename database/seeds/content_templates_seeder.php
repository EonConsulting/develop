<?php

use Illuminate\Database\Seeder;

class content_templates_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $templates = [
            [
                'name' => 'Default',
                'file_path' => 'css/content-templates/default.css',
            ],
            [
                'name' => 'FBN',
                'file_path' => 'css/content-templates/fbn.css',
            ],
            [
                'name' => 'ECS',
                'file_path' => 'css/content-templates/ecs.css',
            ],
            [
                'name' => 'Tourism',
                'file_path' => 'css/content-templates/tourism.css',
            ],
            [
                'name' => 'Cyber Security',
                'file_path' => 'css/content-templates/cyber-security.css',
            ]
        ];

        DB::table('content_templates')->insert($templates);

    }
}
