<?php namespace Unisa\Storycore\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateUnisaStorycoreStorylines extends Migration
{
    public function up()
    {
        Schema::table('unisa_storycore_storylines', function($table)
        {
            $table->text('description')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('unisa_storycore_storylines', function($table)
        {
            $table->dropColumn('description');
        });
    }
}
