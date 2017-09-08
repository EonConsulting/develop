<?php

use Illuminate\Database\Seeder;

class RevisionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_revision_type')->insert(
            [
                'description' => 'Planning',
                'sequence' => 5
            ],
            [
                'description' => 'Pre-Alpha',
                'sequence' => 6
            ],
            [
                'description' => 'Alpha',
                'sequence' => 1
            ],
            [
                'description' => 'Beta',
                'sequence' => 2
            ],
            [
                'description' => 'Production',
                'sequence' => 7
            ],
            [
                'description' => 'Mature',
                'sequence' => 4
            ],
            [
                'description' => 'Inactive',
                'sequence' => 3
            ]
        );
    }
}
