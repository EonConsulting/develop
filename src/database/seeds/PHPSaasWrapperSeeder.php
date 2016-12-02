<?php

use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/12/01
 * Time: 10:16 PM
 */
class PHPSaasWrapperSeeder extends Seeder {

    public function run() {
        \EONConsulting\PHPSaasWrapper\Models\ServiceAvailable::firstOrNew([
            'service_name' => 'Github',
            'service_key' => 'github'
        ]);
    }

}