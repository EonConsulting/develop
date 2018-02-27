<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSummaryModuleProgression extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('summary_module_progression', function (Blueprint $table) {
            $table->unsignedInteger('module_video_progress')->nullable()->default(0)->after('class_progress');
            $table->unsignedInteger('class_video_progress')->nullable()->default(0)->after('module_video_progress');
            $table->unsignedInteger('module_ebook_progress')->nullable()->default(0)->after('class_video_progress');
            $table->unsignedInteger('class_ebook_progress')->nullable()->default(0)->after('module_ebook_progress');
        });

        /*
        DB::statement('ALTER TABLE `summary_module_progression` 
            ADD COLUMN `module_video_progress` integer(11) NOT NULL AFTER `class_progress`');
        DB::statement('ALTER TABLE `summary_module_progression` 
            ADD COLUMN `class_video_progress` integer(11) NOT NULL AFTER `module_video_progress`');
        DB::statement('ALTER TABLE `summary_module_progression` 
            ADD COLUMN `module_ebook_progress` integer(11) NOT NULL AFTER `class_video_progress`');
        DB::statement('ALTER TABLE `summary_module_progression` 
            ADD COLUMN `class_ebook_progress` integer(11) NOT NULL AFTER `module_ebook_progress`');
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('summary_module_progression', function ($table) {
            $table->dropColumn('module_video_progress');
            $table->dropColumn('class_video_progress');
            $table->dropColumn('module_ebook_progress');
            $table->dropColumn('class_ebook_progress');
        });
    }

}
