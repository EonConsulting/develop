<?php namespace Unisa\Storymenu\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateUnisaStorymenuMenu2 extends Migration
{
    public function up()
    {
        Schema::table('unisa_storymenu_menu', function($table)
        {
            $table->foreign('story_id', 'menu_story_id_foreign')->references('id')->on('unisa_storycore_storylines')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('unisa_storymenu_menu', function($table)
        {
            $table->dropForeign('menu_story_id_foreign');
        });
    }
}
