<?php namespace Unisa\Pages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateUnisaPagesPageAssets extends Migration
{
    public function up()
    {
        Schema::create('unisa_pages_page_assets', function($table)
        {
            $table->engine = 'InnoDB';
            $table->bigInteger('pages_id')->unsigned();
            $table->bigInteger('assets_id')->unsigned();
            $table->primary(['pages_id','assets_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('unisa_pages_page_assets');
    }
}
