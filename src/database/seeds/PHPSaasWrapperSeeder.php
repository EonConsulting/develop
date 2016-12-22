<?php

use Illuminate\Database\Seeder;

/**
 * Class PHPSaasWrapperSeeder
 */
class PHPSaasWrapperSeeder extends Seeder {

    /**
     * Seed the database
     */
    public function run() {
        \EONConsulting\PHPSaasWrapper\Models\ServiceAvailable::firstOrNew([
            'service_name' => 'Github',
            'service_key' => 'github'
        ]);
    }

}