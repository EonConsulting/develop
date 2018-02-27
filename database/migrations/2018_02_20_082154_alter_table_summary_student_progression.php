<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSummaryStudentProgression extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('summary_student_progression', function (Blueprint $table) {
            $table->unsignedInteger('video_progress')->nullable()->default(0)->after('progress');
            $table->unsignedInteger('ebook_progress')->nullable()->default(0)->after('video_progress');
        });

        /*
        DB::statement('ALTER TABLE `summary_student_progression` 
            ADD COLUMN `video_progress` integer(10) NOT NULL AFTER `progress`');
        DB::statement('ALTER TABLE `summary_student_progression` 
            ADD COLUMN `ebook_progress` integer(10) NOT NULL AFTER `video_progress`');
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('summary_student_progression', function ($table) {
            $table->dropColumn('video_progress');
            $table->dropColumn('ebook_progress');
        });
    }

}
