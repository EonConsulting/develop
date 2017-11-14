<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOauthAccessTokensTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'oauth_access_tokens';

    /**
     * Run the migrations.
     * @table oauth_access_tokens
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnodDB';
            $table->increments('id');
            $table->integer('user_id')->nullable()->default(null);
            $table->integer('client_id');
            $table->string('name', 191)->nullable()->default(null);
            $table->text('scopes')->nullable()->default(null);
            $table->tinyInteger('revoked');
            $table->dateTime('expires_at')->nullable()->default(null);

            $table->index(["client_id"], 'oauth_access_tokens_client_id_index');

            $table->index(["user_id"], 'oauth_access_tokens_user_id_index');
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
