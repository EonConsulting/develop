<?php namespace Unisa\Pages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateUnisaPagesPageLti extends Migration
{
    public function up()
    {
        Schema::create('unisa_pages_page_lti', function($table)
        {
            $table->engine = 'InnoDB';
            $table->bigInteger('page_id')->unsigned();
            $table->bigInteger('ltiobject_id')->unsigned();
            $table->primary(['page_id','ltiobject_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('unisa_pages_page_lti');
    }
}
