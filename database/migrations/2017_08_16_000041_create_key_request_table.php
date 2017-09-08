<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeyRequestTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'key_request';

    /**
     * Run the migrations.
     * @table key_request
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable($this->set_schema_table)) {
            Schema::create($this->set_schema_table, function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('request_id');
                $table->unsignedInteger('user_id');
                $table->string('title');
                $table->text('notes')->nullable()->default(null);
                $table->text('admin')->nullable()->default(null);
                $table->smallInteger('state')->nullable()->default(null);
                $table->tinyInteger('lti')->nullable()->default(null);
                $table->text('json')->nullable()->default(null);

                $table->index(["user_id"], 'key_request_fk_1');
                $table->timestamps();


                $table->foreign('user_id', 'key_request_fk_1')
                    ->references('user_id')->on('lti_user')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            });
        }
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
