<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLtiContextTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'lti_context';

    /**
     * Run the migrations.
     * @table lti_context
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('context_id');
            $table->char('context_sha256', 64);
            $table->string('context_key');
            $table->unsignedInteger('key_id');
            $table->text('title')->nullable()->default(null);
            $table->text('json')->nullable()->default(null);
            $table->text('settings')->nullable()->default(null);
            $table->text('settings_url')->nullable()->default(null);
            $table->unsignedInteger('entity_version')->default('0');

            $table->index(["context_key"], 'lti_context_ibfk_1');

            $table->unique(["key_id", "context_sha256"], 'key_id');
            $table->timestamps();


            $table->foreign('key_id', 'key_id')
                ->references('key_id')->on('lti_key')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
