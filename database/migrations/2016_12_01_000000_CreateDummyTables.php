<?php

/**
 * Class CreateDummyTables
 */
class CreateDummyTables extends \Illuminate\Database\Migrations\Migration  {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        \Illuminate\Support\Facades\Schema::create('dummy_table', function (\Illuminate\Database\Schema\Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('body');
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        \Illuminate\Support\Facades\Schema::drop('dummy_table');
    }

}