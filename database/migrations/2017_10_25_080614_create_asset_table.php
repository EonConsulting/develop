<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetTable extends Migration
{

    public $set_schema_table = 'assets';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 255)->required();
            $table->text('description')->nullable()->default(null);
            $table->text('content')->nullable()->default(null);
            $table->string('tags',255)->required();
            $table->string('file_name', 255)->nullable()->default(null);
            $table->string('mime_type', 255)->required();            
            $table->unsignedInteger('size')->nullable()->default(null);
            $table->unsignedInteger('creator_id')->nullable()->default(null);
            $table->unsignedInteger('category_id')->nullable()->default(null);
            $table->integer('import_count')->default(0);

            $table->timestamps();

            $table->foreign('creator_id', 'user_ibfk_2')
                ->references('id')->on('users');
            
            $table->foreign('category_id', 'categories_ibfk_2')
                ->references('id')->on('lk_content_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
