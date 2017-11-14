<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetCategoriesTable extends Migration
{


    public $set_schema_table = 'asset_categories';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger("asset_id")->nullable()->default(null);
            $table->unsignedInteger("category_id")->nullable()->default(null);

            $table->timestamps();

            $table->foreign('asset_id', 'asset_ibfk_1')
                ->references('id')->on('assets')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
