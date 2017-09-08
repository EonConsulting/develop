<?php

use Illuminate\Database\Seeder;

class ContentDifficultyTypeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $table = "lk_content_difficulty_type";

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table($table)->truncate();

        DB::table($table)->insert(
                [
                    'description' => 'Easy',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Moderate',
                    'sequence' => 4
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Extreme',
                    'sequence' => 3
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Difficult',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Strenuous',
                    'sequence' => 5
                ]
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
