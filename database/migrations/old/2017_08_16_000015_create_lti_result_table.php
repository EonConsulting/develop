<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLtiResultTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'lti_result';

    /**
     * Run the migrations.
     * @table lti_result
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('result_id');
            $table->unsignedInteger('link_id');
            $table->unsignedInteger('user_id');
            $table->text('result_url')->nullable()->default(null);
            $table->text('sourcedid')->nullable()->default(null);
            $table->unsignedInteger('service_id')->nullable()->default(null);
            $table->string('ipaddr', 64)->nullable()->default(null);
            $table->float('grade')->nullable()->default(null);
            $table->text('note')->nullable()->default(null);
            $table->float('server_grade')->nullable()->default(null);
            $table->text('json')->nullable()->default(null);
            $table->unsignedInteger('entity_version')->default('0');
            $table->timestamp('retrieved_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index(["user_id"], 'lti_result_ibfk_2');

            $table->index(["service_id"], 'lti_result_ibfk_3');

            $table->unique(["link_id", "user_id"], 'link_id');
            $table->timestamps();
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
