<?php namespace Unisa\Storycore\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateUnisaStorycoreStorylines extends Migration
{
    public function up()
    {
        Schema::create('unisa_storycore_storylines', function($table)
        {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->string('story_name');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('unisa_storycore_storylines');
    }
}
