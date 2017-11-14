<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStorylinesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'storylines';

    /**
     * Run the migrations.
     * @table storylines
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('creator_id');
            $table->string('version', 191)->nullable()->default(null);

            $table->index(["creator_id"], 'storylines_ibfk_2');

            $table->index(["course_id"], 'storylines_ibfk_1');
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
