<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLtiUsersDomainsMetaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'lti_users_domains_meta';

    /**
     * Run the migrations.
     * @table lti_users_domains_meta
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('lti_user_id');
            $table->string('app_id', 191);
            $table->string('lti_version', 191);
            $table->string('category', 191);
            $table->string('privacy_level', 191);
            $table->string('user_agent', 191);
            $table->string('display_type', 191);
            $table->text('json')->nullable()->default(null);

            $table->index(["app_id"], 'lti_users_domains_meta_app_id_foreign');
            $table->nullableTimestamps();
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
