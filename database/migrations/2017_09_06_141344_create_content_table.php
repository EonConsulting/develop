<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTable extends Migration
{
    /**
     * Undocumented variable
     *
     * @var string
     */
    public $set_schema_table = 'content';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 255)->required();
            $table->text('body')->nullable()->nullable()->default(null);
            $table->string('tags', 255)->nullable()->nullable()->default(null);
            $table->unsignedInteger("creator_id")->nullable()->default(null);
            
            $table->timestamps();

            $table->foreign('creator_id', 'user_ibfk_1')
                ->references('id')->on('users');
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
