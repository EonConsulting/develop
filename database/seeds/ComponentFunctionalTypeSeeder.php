<?php

use Illuminate\Database\Seeder;

class ComponentFunctionalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_component_functional_type')->insert(
            [
                'description' => 'Analytics',
                'sequence' => 1
            ],
            [
                'description' => 'Study aid (help)',
                'sequence' => 6
            ],
            [
                'description' => 'Assessment',
                'sequence' => 2
            ],
            [
                'description' => 'Content',
                'sequence' => 3
            ],
            [
                'description' => 'Media',
                'sequence' => 5
            ],
            [
                'description' => 'Dashboard',
                'sequence' => 4
            ]
        );
    }
}
