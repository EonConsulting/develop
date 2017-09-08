<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlobFileTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'blob_file';

    /**
     * Run the migrations.
     * @table blob_file
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable($this->set_schema_table)) {
            Schema::create($this->set_schema_table, function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('file_id');
                $table->char('file_sha256', 64);
                $table->unsignedInteger('context_id')->nullable()->default(null);
                $table->string('file_name')->nullable()->default(null);
                $table->tinyInteger('deleted')->nullable()->default(null);
                $table->string('contenttype')->nullable()->default(null);
                $table->string('path')->nullable()->default(null);
                $table->binary('content')->nullable()->default(null);
                $table->text('json')->nullable()->default(null);
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamp('accessed_at')->default(DB::raw('CURRENT_TIMESTAMP'));

                $table->index(["file_sha256"], 'blob_indx_1');

                $table->index(["context_id"], 'blob_ibfk_1');


                $table->foreign('context_id', 'blob_ibfk_1')
                    ->references('context_id')->on('lti_context')
                    ->onDelete('set null')
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
