<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoriesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'stories';

    /**
     * Run the migrations.
     * @table stories
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('parent_id')->nullable()->default(null);
            $table->unsignedInteger('storyline_id');
            $table->integer('lft')->nullable()->default(null);
            $table->integer('rgt')->nullable()->default(null);
            $table->integer('depth')->nullable()->default(null);
            $table->string('title', 191)->nullable()->default(null);
            $table->string('description', 191)->nullable()->default(null);
            $table->longText('file_name')->nullable()->default(null);
            $table->longText('file_url')->nullable()->default(null);

            $table->index(["storyline_id"], 'stories_storyline_id_fbk');
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
