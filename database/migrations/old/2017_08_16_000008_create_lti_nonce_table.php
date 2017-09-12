<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLtiNonceTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'lti_nonce';

    /**
     * Run the migrations.
     * @table lti_nonce
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable($this->set_schema_table)) {
            Schema::create($this->set_schema_table, function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->char('nonce', 128);
                $table->unsignedInteger('key_id');
                $table->unsignedInteger('entity_version');
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

                $table->index(["nonce"], 'nonce_indx_1');

                $table->unique(["key_id", "nonce"], 'key_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
