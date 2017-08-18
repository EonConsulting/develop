<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLtiMembershipTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'lti_membership';

    /**
     * Run the migrations.
     * @table lti_membership
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('membership_id');
            $table->unsignedInteger('context_id');
            $table->unsignedInteger('user_id');
            $table->smallInteger('role')->nullable()->default(null);
            $table->smallInteger('role_override')->nullable()->default(null);
            $table->text('json')->nullable()->default(null);
            $table->unsignedInteger('entity_version')->default('0');

            $table->index(["user_id"], 'lti_membership_ibfk_2');

            $table->unique(["context_id", "user_id"], 'context_id');
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
