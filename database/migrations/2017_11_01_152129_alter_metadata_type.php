<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMetadataType extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public $set_schema_table = 'metadata_types';
    
    public function up() {
        Schema::table($this->set_schema_table, function (Blueprint $table) {
           $table->longText('area')->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
