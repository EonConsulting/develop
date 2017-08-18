<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLtiDomainTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'lti_domain';

    /**
     * Run the migrations.
     * @table lti_domain
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('key_id');
            $table->unsignedInteger('context_id')->nullable()->default(null);
            $table->unsignedInteger('category_id');
            $table->longText('domain')->nullable()->default(null);
            $table->text('description');
            $table->unsignedInteger('port')->nullable()->default(null);
            $table->text('consumer_key')->nullable()->default(null);
            $table->text('secret')->nullable()->default(null);
            $table->text('json')->nullable()->default(null);
            $table->text('logo_uri');
            $table->string('app_categories');

            $table->index(["category_id"], 'category_id_index');

            $table->index(["context_id"], 'lti_domain_ibfk_2');

            $table->unique(["key_id", "context_id"], 'key_id');
            $table->timestamps();


            $table->foreign('category_id', 'category_id_index')
                ->references('id')->on('lti_app_categories')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('key_id', 'key_id')
                ->references('key_id')->on('lti_key')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('context_id', 'lti_domain_ibfk_2')
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
