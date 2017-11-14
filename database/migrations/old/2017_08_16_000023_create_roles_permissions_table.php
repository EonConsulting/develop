<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesPermissionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'roles_permissions';

    /**
     * Run the migrations.
     * @table roles_permissions
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable($this->set_schema_table)) {
            Schema::create($this->set_schema_table, function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('role_id');
                $table->unsignedInteger('permission_id');

                $table->index(["permission_id"], 'roles_permissions_permission_id_foreign');
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
