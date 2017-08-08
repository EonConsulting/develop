<?php namespace Unisa\Storymenu\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateUnisaStorymenuMenu extends Migration
{
    public function up()
    {
        Schema::table('unisa_storymenu_menu', function($table)
        {
            $table->integer('user_id')->nullable(false)->unsigned()->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('unisa_storymenu_menu', function($table)
        {
            $table->bigInteger('user_id')->nullable(false)->unsigned()->default(null)->change();
        });
    }
}
