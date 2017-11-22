<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //DB::statement('ALTER TABLE `student_progress` ALTER `storyline_item_id` DROP DEFAULT;');
        DB::statement('ALTER TABLE `roles` CHANGE `slug` 
                       `description` TEXT NULL;
');
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
