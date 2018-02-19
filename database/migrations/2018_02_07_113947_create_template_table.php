<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateTable extends Migration
{

    private $table = 'templates';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable($table)){

            Schema::create($table, function (Blueprint $table) {
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
            $table->foreign('template_id', 'template_ibfk_1')
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
        Schema::table($table, function (Blueprint $table) {
            $table->dropForeign('user_ibfk_3');
        });
        
        Schema::dropIfExists('templates');
    }
}
