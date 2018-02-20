<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('templates')){
            Schema::create('templates', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('file_name');
                $table->text('styles');
                $table->unsignedInteger('creator_id');
               
                $table->timestamps();
    
                $table->foreign('creator_id', 'user_ibfk_3')
                    ->references('id')->on('users');
            });
        }
    
        Schema::table('courses', function (Blueprint $table) {
            $table->unsignedInteger('template_id')->nullable()->default(null);

            $table->foreign('template_id', 'template_ibfk_8')
                ->references('id')->on('templates');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('templates', function (Blueprint $table) {
            $table->dropForeign('user_ibfk_3');
        });
        
        Schema::dropIfExists('templates');
    }
}
