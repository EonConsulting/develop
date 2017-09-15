<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'permissions';

    /**
     * Run the migrations.
     * @table permissions
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable($this->set_schema_table)) {
            Schema::create($this->set_schema_table, function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('name', 191);
                $table->string('slug', 191);
                $table->timestamps();
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
