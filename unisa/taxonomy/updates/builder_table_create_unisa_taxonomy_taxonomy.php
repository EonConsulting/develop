<?php namespace Unisa\Taxonomy\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateUnisaTaxonomyTaxonomy extends Migration
{
    public function up()
    {
        Schema::create('unisa_taxonomy_taxonomy', function($table)
        {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('taxonomy_name');
            $table->text('description')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('unisa_taxonomy_taxonomy');
    }
}
