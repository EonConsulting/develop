<?php namespace Unisa\Storymenu\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateUnisaStorymenuMenu extends Migration
{
    public function up()
    {
        Schema::create('unisa_storymenu_menu', function($table)
        {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('story_id')->unsigned();
            $table->string('menu_title');
            $table->text('page_url');
            $table->text('description')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('unisa_storymenu_menu');
    }
}
