<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLtiServiceTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'lti_service';

    /**
     * Run the migrations.
     * @table lti_service
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('service_id');
            $table->char('service_sha256', 64);
            $table->text('service_key');
            $table->unsignedInteger('key_id');
            $table->string('format')->nullable()->default(null);
            $table->text('json')->nullable()->default(null);
            $table->unsignedInteger('entity_version')->default('0');

            $table->unique(["key_id", "service_sha256"], 'key_id');
            $table->timestamps();
        });
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
