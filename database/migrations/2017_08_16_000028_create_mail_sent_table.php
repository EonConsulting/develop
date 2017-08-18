<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailSentTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'mail_sent';

    /**
     * Run the migrations.
     * @table mail_sent
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('sent_id');
            $table->unsignedInteger('context_id');
            $table->unsignedInteger('link_id')->nullable()->default(null);
            $table->unsignedInteger('user_to')->nullable()->default(null);
            $table->unsignedInteger('user_from')->nullable()->default(null);
            $table->string('subject')->nullable()->default(null);
            $table->text('body')->nullable()->default(null);
            $table->text('json')->nullable()->default(null);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index(["context_id"], 'mail_sent_ibfk_1');

            $table->index(["link_id"], 'mail_sent_ibfk_2');

            $table->index(["user_to"], 'mail_sent_ibfk_3');

            $table->index(["user_from"], 'mail_sent_ibfk_4');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
