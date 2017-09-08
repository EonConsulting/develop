<?php

use Illuminate\Database\Seeder;

class AccessTypeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $table = "lk_access_type";
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table($table)->truncate();

        DB::table($table)->insert(
                [
                    'description' => 'Internal Use',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'description' => 'Open to public',
                    'sequence' => 2
                ]
        );
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}