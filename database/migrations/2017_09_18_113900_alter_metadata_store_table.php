<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStudentProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `metadata_store`
            ADD COLUMN `entities` VARCHAR(255) NULL DEFAULT NULL AFTER `sequence`;');
        
        DB::statement('UPDATE metadata_store SET entities = \'content\' 
                WHERE metadata_type IN (
                    \'Content Information Types\', 
                    \'Content Difficulty Type\',
                    \'Content Progress Type\',
                    \'Content Usage Type\', 
                    \'Content Tag Type\', 
                    \'Coverage Type\',
                    \'Content Type\',
                    \'Rating Type\',
                    \'Revision Type\');');
        
        DB::statement('UPDATE metadata_store SET entities = \'student:mentor\'
            WHERE metadata_type IN (
                \'Collaboration Type\');');
        
        DB::statement('UPDATE metadata_store SET entities = \'content:storyline\'
            WHERE metadata_type IN (
                \'Discipline Type\',
                \'Pedagogical Type\');');
        
        DB::statement('UPDATE metadata_store SET entities = \'storyline:student\'
            WHERE metadata_type IN (
                \'Qualification Type\');');

        DB::statement('UPDATE metadata_store SET entities = \'content:storyline:student\'
            WHERE metadata_type IN (
                \'College Type\');');
        
        DB::statement('UPDATE metadata_store SET entities = \'storyline\'
            WHERE metadata_type IN (
                    \'School Type\',
                    \'Department Type\',
                    \'Centre Type\',
                    \'Institute Type\',
                    \'Duration Type\',
                    \'Expiration Type\');');
        
        DB::statement('UPDATE metadata_store SET entities = \'student\'
            WHERE metadata_type IN (
                    \'Interest Type\',
                    \'Status Type\',
                    \'Profile Type\',
                    \'Student Cycle Type\',
                    \'Term Cycle Type\',
                    \'Enrolment Type\',
                    \'Study Type\',
                    \'Goal Type\');');
        
        DB::statement('UPDATE metadata_store SET entities = \'lecturer\'
            WHERE metadata_type IN (
                    \'Creator Type\');');
        
        DB::statement('UPDATE metadata_store SET entities = \'content:user\'
            WHERE metadata_type IN (
                    \'Role Type\');');
        
        DB::statement('UPDATE metadata_store SET entities = \'lecturer:storyline:student\'
            WHERE metadata_type IN (
                    \'Institution Type\');');
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
