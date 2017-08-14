<?php

/**
 * Class PHPSaasWrapperMigrations
 */
class PHPSaasWrapperMigrations extends \Illuminate\Database\Migrations\Migration  {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        \Illuminate\Support\Facades\Schema::create('psw_services_available', function (\Illuminate\Database\Schema\Blueprint $table) {
            $table->increments('service_id');
            $table->string('service_name');
            $table->string('service_key'); // the 'key' in the service class
            $table->timestamps();
        });
        \Illuminate\Support\Facades\Schema::create('psw_services_linked', function (\Illuminate\Database\Schema\Blueprint $table) {
            $table->increments('service_link_id');
            $table->integer('service_id');
            $table->string('token');
            $table->integer('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        \Illuminate\Support\Facades\Schema::drop('psw_services_available');
        \Illuminate\Support\Facades\Schema::drop('psw_services_linked');
    }

}