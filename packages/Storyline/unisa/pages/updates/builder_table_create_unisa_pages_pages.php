<?php namespace Unisa\Pages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateUnisaPagesPages extends Migration
{
    public function up()
    {
        Schema::create('unisa_pages_pages', function($table)
        {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('page_name');
            $table->string('page_title');
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();
            $table->text('summary');
            $table->string('preview')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('unisa_pages_pages');
    }
}
