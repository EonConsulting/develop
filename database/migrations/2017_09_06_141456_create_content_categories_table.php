<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentCategoriesTable extends Migration
{
    /**
     * Undocumented variable
     *
     * @var string
     */
    public $set_schema_table = 'content_categories';
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger("content_id")->nullable()->default(null);
            $table->unsignedInteger("category_id")->nullable()->default(null);

            $table->timestamps();

            $table->foreign('content_id', 'content_ibfk_1')
                ->references('id')->on('content')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('category_id', 'categories_ibfk_1')
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
