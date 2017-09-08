<?php

use Illuminate\Database\Seeder;

class OfficeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lk_office_type')->insert(
            [
                'description' => 'Ethiopia Graduate Office (EGO)',
                'sequence' => 1
            ]
        );
    }
}
