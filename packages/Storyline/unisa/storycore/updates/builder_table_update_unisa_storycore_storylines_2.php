<?php namespace Unisa\Storycore\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateUnisaStorycoreStorylines2 extends Migration
{
    public function up()
    {
        Schema::table('unisa_storycore_storylines', function($table)
        {
            $table->bigInteger('user_id')->unsigned();
        });
    }
    
    public function down()
    {
        Schema::table('unisa_storycore_storylines', function($table)
        {
            $table->dropColumn('user_id');
        });
    }
}
