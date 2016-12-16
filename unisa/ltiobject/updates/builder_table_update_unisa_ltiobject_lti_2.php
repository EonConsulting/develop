<?php namespace Unisa\Ltiobject\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateUnisaLtiobjectLti2 extends Migration
{
    public function up()
    {
        Schema::table('unisa_ltiobject_lti', function($table)
        {
            $table->text('launcher_url');
            $table->string('key');
            $table->string('secret');
        });
    }
    
    public function down()
    {
        Schema::table('unisa_ltiobject_lti', function($table)
        {
            $table->dropColumn('launcher_url');
            $table->dropColumn('key');
            $table->dropColumn('secret');
        });
    }
}
