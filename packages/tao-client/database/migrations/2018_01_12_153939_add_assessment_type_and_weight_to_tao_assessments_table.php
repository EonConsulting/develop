<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAssessmentTypeAndWeightToTaoAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tao_assessments', function (Blueprint $table) {
            $table->string('assessment_type');
            $table->string('assessment_weight')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tao_assessments', function (Blueprint $table) {
            $table->dropColumn('assessment_type');
            $table->dropColumn('assessment_weight');
        });
    }
}
