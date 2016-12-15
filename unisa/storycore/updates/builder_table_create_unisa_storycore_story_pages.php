<?php namespace Unisa\Storycore\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateUnisaStorycoreStoryPages extends Migration
{
    public function up()
    {
        Schema::create('unisa_storycore_story_pages', function($table)
        {
            $table->engine = 'InnoDB';
            $table->bigInteger('storycore_id')->unsigned();
            $table->bigInteger('page_id')->unsigned();
            $table->primary(['storycore_id','page_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('unisa_storycore_story_pages');
    }
}
