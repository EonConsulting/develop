<?php namespace Unisa\Ltiobject\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateUnisaLtiobjectLti extends Migration
{
    public function up()
    {
        Schema::table('unisa_ltiobject_lti', function($table)
        {
            $table->renameColumn('object_link', 'endpoint_url');
        });
    }
    
    public function down()
    {
        Schema::table('unisa_ltiobject_lti', function($table)
        {
            $table->renameColumn('endpoint_url', 'object_link');
        });
    }
}
