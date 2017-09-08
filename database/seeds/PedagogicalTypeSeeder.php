<?php

use Illuminate\Database\Seeder;

class PedagogicalTypeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $table = "lk_pedagogical_type";

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table($table)->truncate();

        DB::table($table)->insert(
                [
                    'description' => 'Outcome Based',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Schedule Based',
                    'sequence' => 3
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Content Based',
                    'sequence' => 1
                ]
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
