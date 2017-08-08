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
            $table->bigInteger('page_id')->unsigned();
            $table->bigInteger('asset_id')->unsigned();
            $table->primary(['page_id','asset_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('unisa_pages_page_assets');
    }
}
