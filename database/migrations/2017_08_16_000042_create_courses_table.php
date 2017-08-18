<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'courses';

    /**
     * Run the migrations.
     * @table courses
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 191);
            $table->longText('description')->nullable()->default(null);
            $table->longText('featured_image')->nullable()->default(null);
            $table->longText('tags')->nullable()->default(null);
            $table->string('xml_file', 191)->nullable()->default(null);
            $table->unsignedInteger('creator_id');

            $table->index(["creator_id"], 'courses_ibfk_1');
            $table->timestamps();


            $table->foreign('creator_id', 'courses_ibfk_1')
                ->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
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
