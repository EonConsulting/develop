<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsPluginsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'lms_plugins';

    /**
     * Run the migrations.
     * @table lms_plugins
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('plugin_id');
            $table->string('plugin_path');
            $table->bigInteger('version');
            $table->string('title')->nullable()->default(null);
            $table->text('json')->nullable()->default(null);

            $table->unique(["plugin_path"], 'plugin_path');
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
