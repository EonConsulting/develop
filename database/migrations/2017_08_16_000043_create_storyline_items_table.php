<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStorylineItemsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'storyline_items';

    /**
     * Run the migrations.
     * @table storyline_items
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable()->default(null);
            $table->unsignedInteger('storyline_id')->nullable()->default(null);
            $table->integer('root_parent')->nullable()->default(null);
            $table->integer('level')->nullable()->default(null);
            $table->integer('_lft')->nullable()->default(null);
            $table->integer('_rgt')->nullable()->default(null);
            $table->integer('previous')->nullable()->default(null);
            $table->integer('next')->nullable()->default(null);
            $table->integer('ordering')->nullable()->default(null);
            $table->string('type', 191)->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->string('topics')->nullable()->default(null);
            $table->string('description', 191)->nullable()->default(null);
            $table->longText('file_url')->nullable()->default(null);
            $table->longText('file_name')->nullable()->default(null);
            $table->text('page_trail')->nullable()->default(null);
            $table->integer('position')->nullable()->default(null);
            $table->string('names', 191)->nullable()->default(null);
            $table->longText('file_url_backup')->nullable()->default(null);

            $table->index(["storyline_id"], 'storyline_id');

            $table->index(["storyline_id"], 'storyline_items_ibfk_1');
            $table->timestamps();


            $table->foreign('storyline_id', 'storyline_items_ibfk_1')
                ->references('id')->on('storylines')
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
