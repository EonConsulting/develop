<?php namespace Unisa\Pages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateUnisaPagesPages extends Migration
{
    public function up()
    {
        Schema::table('unisa_pages_pages', function($table)
        {
            $table->string('page_title', 255)->nullable()->change();
            $table->text('summary')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('unisa_pages_pages', function($table)
        {
            $table->string('page_title', 255)->nullable(false)->change();
            $table->text('summary')->nullable(false)->change();
        });
    }
}
