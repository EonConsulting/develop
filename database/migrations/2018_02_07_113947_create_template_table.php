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

        $this->add_default_template();
    
        Schema::table('courses', function (Blueprint $table) {
            $table->unsignedInteger('template_id')->default(1);

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

    private function add_default_template(){
        DB::table('templates')->insert(
            array(
                'name' => 'Default',
                'styles' => '{".title":{"color":"#4d4d4d","font-size":"32px","font-weight":"normal","font-style":"normal","text-decoration":"none","text-transform":"uppercase","font-variant":"normal","text-align":"left","background":"none","padding-top":"0","padding-right":"0","padding-bottom":"0","padding-left":"0","border-top-width":"0","border-top-style":"none","border-top-color":"none","border-right-width":"0","border-right-style":"none","border-right-color":"none","border-bottom-width":"0","border-bottom-style":"none","border-bottom-color":"none","border-left-width":"0","border-left-style":"none","border-left-color":"none"},".subtitle":{"color":"#949494","font-size":"24px","font-weight":"normal","font-style":"normal","text-decoration":"none","text-transform":"uppercase","font-variant":"normal","text-align":"left","background":"none","padding-top":"0","padding-right":"0","padding-bottom":"0","padding-left":"0","border-top-width":"0","border-top-style":"none","border-top-color":"none","border-right-width":"0","border-right-style":"none","border-right-color":"none","border-bottom-width":"0","border-bottom-style":"none","border-bottom-color":"none","border-left-width":"0","border-left-style":"none","border-left-color":"none"},"h1":{"color":"#002f66","font-size":"28px","font-weight":"bold","font-style":"normal","text-decoration":"none","text-transform":"uppercase","font-variant":"normal","text-align":"left","background":"#ffffff","padding-top":"0","padding-right":"0","padding-bottom":"0","padding-left":"0","border-top-width":"0","border-top-style":"none","border-top-color":"#ffffff","border-right-width":"0","border-right-style":"none","border-right-color":"#ffffff","border-bottom-width":"1","border-bottom-style":"solid","border-bottom-color":"#002f66","border-left-width":"0","border-left-style":"none","border-left-color":"#ffffff"},"h2":{"color":"#f6921e","font-size":"24px","font-weight":"bold","font-style":"normal","text-decoration":"none","text-transform":"uppercase","font-variant":"normal","text-align":"left","background":"none","padding-top":"0","padding-right":"0","padding-bottom":"0","padding-left":"0","border-top-width":"0","border-top-style":"none","border-top-color":"none","border-right-width":"0","border-right-style":"none","border-right-color":"none","border-bottom-width":"o","border-bottom-style":"none","border-bottom-color":"none","border-left-width":"0","border-left-style":"none","border-left-color":"none"},"h3":{"color":"#a80f14","font-size":"20px","font-weight":"normal","font-style":"normal","text-decoration":"none","text-transform":"uppercase","font-variant":"normal","text-align":"left","background":"none","padding-top":"0","padding-right":"0","padding-bottom":"0","padding-left":"0","border-top-width":"0","border-top-style":"none","border-top-color":"none","border-right-width":"0","border-right-style":"none","border-right-color":"none","border-bottom-width":"0","border-bottom-style":"none","border-bottom-color":"none","border-left-width":"0","border-left-style":"none","border-left-color":"none"},"h4":{"color":"#4d4d4d","font-size":"18px","font-weight":"bold","font-style":"normal","text-decoration":"none","text-transform":"uppercase","font-variant":"normal","text-align":"left","background":"none","padding-top":"0","padding-right":"0","padding-bottom":"0","padding-left":"0","border-top-width":"0","border-top-style":"none","border-top-color":"none","border-right-width":"0","border-right-style":"none","border-right-color":"none","border-bottom-width":"0","border-bottom-style":"none","border-bottom-color":"none","border-left-width":"0","border-left-style":"none","border-left-color":"none"},"p":{"color":"#000000","font-size":"14px","font-weight":"normal","font-style":"normal","text-decoration":"none","text-transform":"none","font-variant":"normal","text-align":"left","background":"none","padding-top":"0","padding-right":"0","padding-bottom":"0","padding-left":"0","border-top-width":"0","border-top-style":"none","border-top-color":"none","border-right-width":"0","border-right-style":"none","border-right-color":"none","border-bottom-width":"0","border-bottom-style":"none","border-bottom-color":"none","border-left-width":"0","border-left-style":"none","border-left-color":"none"},".quote":{"color":"#666","font-size":"14px","font-weight":"normal","font-style":"italic","text-decoration":"none","text-transform":"none","font-variant":"normal","text-align":"left","background":"none","padding-top":"0","padding-right":"0","padding-bottom":"0","padding-left":"0","border-top-width":"0","border-top-style":"none","border-top-color":"none","border-right-width":"0","border-right-style":"none","border-right-color":"none","border-bottom-width":"0","border-bottom-style":"none","border-bottom-color":"none","border-left-width":"0","border-left-style":"none","border-left-color":"none"},".self_assessment":{"color":"#000000","font-size":"16px","font-weight":"normal","font-style":"normal","text-decoration":"none","text-transform":"none","font-variant":"normal","text-align":"left","background":"none","padding-top":"0","padding-right":"0","padding-bottom":"0","padding-left":"15px","border-top-width":"0","border-top-style":"none","border-top-color":"none","border-right-width":"0","border-right-style":"none","border-right-color":"none","border-bottom-width":"0","border-bottom-style":"none","border-bottom-color":"none","border-left-width":"3px","border-left-style":"solid","border-left-color":"#71bf49"},".video":{"color":"#000000","font-size":"16px","font-weight":"normal","font-style":"normal","text-decoration":"none","text-transform":"none","font-variant":"normal","text-align":"left","background":"none","padding-top":"0","padding-right":"0","padding-bottom":"0","padding-left":"15px","border-top-width":"0","border-top-style":"none","border-top-color":"none","border-right-width":"0","border-right-style":"none","border-right-color":"none","border-bottom-width":"0","border-bottom-style":"none","border-bottom-color":"none","border-left-width":"3px","border-left-style":"solid","border-left-color":"#0077c7"},".graph":{"color":"#000000","font-size":"16px","font-weight":"normal","font-style":"normal","text-decoration":"none","text-transform":"none","font-variant":"normal","text-align":"left","background":"none","padding-top":"0","padding-right":"0","padding-bottom":"0","padding-left":"15px","border-top-width":"0","border-top-style":"none","border-top-color":"none","border-right-width":"0","border-right-style":"none","border-right-color":"none","border-bottom-width":"0","border-bottom-style":"none","border-bottom-color":"none","border-left-width":"3px","border-left-style":"solid","border-left-color":"#da7a1d"},".text":{"color":"#000000","font-size":"16px","font-weight":"normal","font-style":"normal","text-decoration":"none","text-transform":"none","font-variant":"normal","text-align":"left","background":"none","padding-top":"0","padding-right":"0","padding-bottom":"0","padding-left":"15px","border-top-width":"0","border-top-style":"none","border-top-color":"none","border-right-width":"0","border-right-style":"none","border-right-color":"none","border-bottom-width":"0","border-bottom-style":"none","border-bottom-color":"none","border-left-width":"3px","border-left-style":"solid","border-left-color":"#cbac6f"},".equation":{"color":"#000000","font-size":"16px","font-weight":"normal","font-style":"normal","text-decoration":"none","text-transform":"none","font-variant":"normal","text-align":"left","background":"none","padding-top":"0","padding-right":"0","padding-bottom":"0","padding-left":"15px","border-top-width":"0","border-top-style":"none","border-top-color":"none","border-right-width":"0","border-right-style":"none","border-right-color":"none","border-bottom-width":"0","border-bottom-style":"none","border-bottom-color":"none","border-left-width":"3px","border-left-style":"solid","border-left-color":"#664139"},".activity":{"color":"#000000","font-size":"16px","font-weight":"normal","font-style":"normal","text-decoration":"none","text-transform":"none","font-variant":"normal","text-align":"left","background":"none","padding-top":"0","padding-right":"0","padding-bottom":"0","padding-left":"15px","border-top-width":"0","border-top-style":"none","border-top-color":"none","border-right-width":"0","border-right-style":"none","border-right-color":"none","border-bottom-width":"0","border-bottom-style":"none","border-bottom-color":"none","border-left-width":"3px","border-left-style":"solid","border-left-color":"#009576"},".image":{"color":"#000000","font-size":"16px","font-weight":"normal","font-style":"normal","text-decoration":"none","text-transform":"none","font-variant":"normal","text-align":"left","background":"none","padding-top":"0","padding-right":"0","padding-bottom":"0","padding-left":"15px","border-top-width":"0","border-top-style":"none","border-top-color":"none","border-right-width":"0","border-right-style":"none","border-right-color":"none","border-bottom-width":"0","border-bottom-style":"none","border-bottom-color":"none","border-left-width":"3px","border-left-style":"solid","border-left-color":"#b82c2d"},".final_assessment":{"color":"#000000","font-size":"16px","font-weight":"normal","font-style":"normal","text-decoration":"none","text-transform":"none","font-variant":"normal","text-align":"left","background":"none","padding-top":"0","padding-right":"0","padding-bottom":"0","padding-left":"15px","border-top-width":"0","border-top-style":"none","border-top-color":"none","border-right-width":"0","border-right-style":"none","border-right-color":"none","border-bottom-width":"0","border-bottom-style":"none","border-bottom-color":"none","border-left-width":"3px","border-left-style":"solid","border-left-color":"#172652"},".chain":{"color":"#000000","font-size":"16px","font-weight":"normal","font-style":"normal","text-decoration":"none","text-transform":"none","font-variant":"normal","text-align":"left","background":"none","padding-top":"0","padding-right":"0","padding-bottom":"0","padding-left":"15px","border-top-width":"0","border-top-style":"none","border-top-color":"none","border-right-width":"0","border-right-style":"none","border-right-color":"none","border-bottom-width":"0","border-bottom-style":"none","border-bottom-color":"none","border-left-width":"3px","border-left-style":"solid","border-left-color":"#777777"}}',
                'creator_id' => 1
            )
        );
    }
}

