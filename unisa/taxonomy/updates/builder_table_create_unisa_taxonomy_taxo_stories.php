<?php namespace Unisa\Taxonomy\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateUnisaTaxonomyTaxoStories extends Migration
{
    public function up()
    {
        Schema::create('unisa_taxonomy_taxo_stories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->bigInteger('taxonomy_id')->unsigned();
            $table->bigInteger('storycore_id')->unsigned();
            $table->primary(['taxonomy_id','storycore_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('unisa_taxonomy_taxo_stories');
    }
}
