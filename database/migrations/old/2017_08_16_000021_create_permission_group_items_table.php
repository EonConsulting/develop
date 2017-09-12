<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionGroupItemsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'permission_group_items';

    /**
     * Run the migrations.
     * @table permission_group_items
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable($this->set_schema_table)) {
            Schema::create($this->set_schema_table, function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('permission_group_id');
                $table->unsignedInteger('group_id');
                $table->unsignedInteger('permission_id');

                $table->index(["group_id"], 'permission_group_items_group_id_foreign');

                $table->index(["permission_id"], 'permission_group_items_permission_id_foreign');
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
