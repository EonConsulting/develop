<?php

use Illuminate\Database\Seeder;

class DisciplineTypeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $table = "lk_discipline_type";

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table($table)->truncate();

        DB::table($table)->insert(
                [
                    'classification' => "arts",
                    'description' => 'Performing Arts',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'classification' => 'arts',
                    'description' => 'Visual Arts',
                    'sequence' => 2
                ]
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
