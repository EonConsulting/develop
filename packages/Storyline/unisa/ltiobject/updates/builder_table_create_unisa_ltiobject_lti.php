<?php namespace Unisa\Ltiobject\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateUnisaLtiobjectLti extends Migration
{
    public function up()
    {
        Schema::create('unisa_ltiobject_lti', function($table)
        {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('object_name');
            $table->text('description')->nullable();
            $table->text('object_link');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('unisa_ltiobject_lti');
    }
}
