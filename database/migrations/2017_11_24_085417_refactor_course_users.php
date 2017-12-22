<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefactorCourseUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (Schema::hasTable('course_users')) {
			Schema::table('course_users', function (Blueprint $table) {
				$table->dropColumn('email');
				$table->dropColumn('opted_out');
				$table->dropColumn('opted_out_date');
			});
			Schema::rename('course_users', 'integrate_course_users');
		}

		
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
