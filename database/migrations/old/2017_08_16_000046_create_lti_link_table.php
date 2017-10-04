<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLtiLinkTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'lti_link';

    /**
     * Run the migrations.
     * @table lti_link
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('link_id');
            $table->char('link_sha256', 64);
            $table->text('link_key');
            $table->unsignedInteger('context_id');
            $table->text('path')->nullable()->default(null);
            $table->text('title')->nullable()->default(null);
            $table->text('json')->nullable()->default(null);
            $table->text('settings')->nullable()->default(null);
            $table->text('settings_url')->nullable()->default(null);
            $table->unsignedInteger('entity_version')->default('0');

            $table->index(["context_id"], 'lti_link_ibfk_1');

            $table->unique(["link_sha256", "context_id"], 'link_sha256');
            $table->timestamps();


            $table->foreign('context_id', 'lti_link_ibfk_1')
                ->references('context_id')->on('lti_context')
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
