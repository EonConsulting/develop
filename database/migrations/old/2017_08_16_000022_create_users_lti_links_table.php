<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersLtiLinksTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'users_lti_links';

    /**
     * Run the migrations.
     * @table users_lti_links
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('lti_user_id', 13);
            $table->string('context_id');
            $table->string('lis_person_contact_email_primary', 191);
            $table->string('lis_person_name_family', 191);
            $table->string('lis_person_name_full', 191);
            $table->string('lis_person_name_given', 191);
            $table->string('lis_person_sourcedid', 191);
            $table->string('lis_result_sourcedid', 191);
            $table->string('roles', 191);

            $table->index(["lti_user_id"], 'users_lti_links_ibfk_2');

            $table->index(["context_id"], 'users_lti_links_ibfk_3');

            $table->index(["user_id"], 'users_lti_links_ibfk_1');
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
