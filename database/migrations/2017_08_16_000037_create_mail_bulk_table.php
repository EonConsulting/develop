<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailBulkTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'mail_bulk';

    /**
     * Run the migrations.
     * @table mail_bulk
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('bulk_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('context_id');
            $table->string('subject')->nullable()->default(null);
            $table->text('body')->nullable()->default(null);
            $table->text('json')->nullable()->default(null);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index(["user_id"], 'mail_bulk_ibfk_2');

            $table->index(["context_id"], 'mail_bulk_ibfk_1');
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
