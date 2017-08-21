<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersPermissionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'users_permissions';

    /**
     * Run the migrations.
     * @table users_permissions
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('user_id');
            $table->unsignedInteger('permission_id');
            $table->unsignedInteger('group_id')->default('0');
            $table->tinyInteger('has_permission')->default('1');

            $table->index(["group_id"], 'users_permissions_group_id_foreign');

            $table->index(["permission_id"], 'users_permissions_permission_id_foreign');
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
