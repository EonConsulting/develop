<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropContentTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('courses', function (Blueprint $table) {
            $table->dropIndex('template_ibfk_1');
            $table->dropForeign('template_ibfk_1');

            $table->dropcolumn('template_id');
        });
        
        if(Schema::hasTable('content_templates')){
            Schema::dropIfExists('content_templates');
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('content_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->required();
            $table->string('file_path')->required();
            $table->timestamps();
        });
    }
}
