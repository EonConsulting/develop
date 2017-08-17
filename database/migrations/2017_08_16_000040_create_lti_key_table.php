<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLtiKeyTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'lti_key';

    /**
     * Run the migrations.
     * @table lti_key
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('key_id');
            $table->char('key_sha256', 64);
            $table->text('key_key');
            $table->text('secret')->nullable()->default(null);
            $table->text('new_secret')->nullable()->default(null);
            $table->text('ack')->nullable()->default(null);
            $table->unsignedInteger('user_id')->nullable()->default(null);
            $table->text('consumer_profile')->nullable()->default(null);
            $table->text('new_consumer_profile')->nullable()->default(null);
            $table->text('tool_profile')->nullable()->default(null);
            $table->text('new_tool_profile')->nullable()->default(null);
            $table->text('json')->nullable()->default(null);
            $table->text('settings')->nullable()->default(null);
            $table->text('settings_url')->nullable()->default(null);
            $table->unsignedInteger('entity_version')->default('0');
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
