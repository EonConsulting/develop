<?php namespace Unisa\Assets\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateUnisaAssetsAssets extends Migration
{
    public function up()
    {
        Schema::create('unisa_assets_assets', function($table)
        {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('asset_name');
            $table->string('file_name');
            $table->text('description')->nullable();
            $table->text('content');
            $table->boolean('is_published');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('unisa_assets_assets');
    }
}
