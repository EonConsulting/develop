<?php

use Illuminate\Database\Seeder;

class ContentUsageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_content_usage_type')->insert(
            [
                'description' => 'Always',
                'sequence' => 1
            ],
            [
                'description' => 'Often',
                'sequence' => 3
            ],
            [
                'description' => 'Sometimes',
                'sequence' => 5
            ],
            [
                'description' => 'Rarely',
                'sequence' => 4
            ],
            [
                'description' => 'Never',
                'sequence' => 2
            ]
        );
    }
}
