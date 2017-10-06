<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLtiUserDomainsMeta extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lti_users_domains_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('lti_user_id')->unsigned();
            $table->string('app_id');
            $table->string('lti_version');
            $table->string('category');
            $table->string('privacy_level');
            $table->string('user_agent');
            $table->string('display_type');
            $table->timestamps();
        });

        Schema::table('lti_users_domains_meta', function(Blueprint $table) {
            $table->foreign('app_id')->references('context_id')->on('lti_domain')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lti_users_domains_meta');
    }
}