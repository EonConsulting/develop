<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMetadataType extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        //DB::statement('ALTER TABLE `metadata_types` CHANGE `area` `area` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;');
		if (!Schema::hasColumn('metadata_types', 'area')) {
			Schema::table('metadata_types', function (Blueprint $table) {
				$table->char('email', 50)->charset('utf8mb4')->nullable(true);
			});
		}
	}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
