<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLtiUserTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'lti_user';

    /**
     * Run the migrations.
     * @table lti_user
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('user_id');
            $table->char('user_sha256', 64);
            $table->string('user_key', 13);
            $table->unsignedInteger('key_id');
            $table->unsignedInteger('profile_id')->nullable()->default(null);
            $table->text('displayname')->nullable()->default(null);
            $table->text('email')->nullable()->default(null);
            $table->char('locale', 63)->nullable()->default(null);
            $table->smallInteger('subscribe')->nullable()->default(null);
            $table->text('json')->nullable()->default(null);
            $table->timestamp('login_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('ipaddr', 64)->nullable()->default(null);
            $table->unsignedInteger('entity_version')->default('0');

            $table->index(["user_key"], 'lti_user_ibfk_2');

            $table->unique(["key_id", "user_sha256"], 'key_id');
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
