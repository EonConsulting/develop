<?php

use Illuminate\Database\Seeder;

class MetadataTypeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $table = "metadata_store";

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table($table)->truncate();

        DB::table($table)->insert(
                [
                    'name' => 'Access Type',
                    'description' => 'Access Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Application Type',
                    'description' => 'Application Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Bureau Type',
                    'description' => 'Bureau Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Centre Type',
                    'description' => 'Centre Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Chair Type',
                    'description' => 'Chair Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Collaboration Type',
                    'description' => 'Collaboration Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'College Type',
                    'description' => 'College Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Component Functional Type',
                    'description' => 'Component Functional Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Concern Type',
                    'description' => 'Concern Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Content Difficulty Type',
                    'description' => 'Content Difficulty Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Content Info Type',
                    'description' => 'Content Info Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Content Progress Type',
                    'description' => 'Content Progress Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Content Tag Type',
                    'description' => 'Content Tag Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Content Usage Type',
                    'description' => 'Content Usage Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Contributor Type',
                    'description' => 'Contributor Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Costing Type',
                    'description' => 'Costing Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Coverage Type',
                    'description' => 'Coverage Type'
                ]
        );


        DB::table($table)->insert(
                [
                    'name' => 'Creator Type',
                    'description' => 'Creator Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Date Time Type',
                    'description' => 'Date Time Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Department Type',
                    'description' => 'Department Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Discipline Type',
                    'description' => 'Discipline Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Distribution Type',
                    'description' => 'Distribution Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Duration Type',
                    'description' => 'Duration Type'
                ]
        );


        DB::table($table)->insert(
                [
                    'name' => 'Enrolment Type',
                    'description' => 'Enrolment Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Expiration Type',
                    'description' => 'Expiration Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Goal Type',
                    'description' => 'Goal Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Institute Type',
                    'description' => 'Institute Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Institution Type',
                    'description' => 'Institution Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Interest Type',
                    'description' => 'Interest Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'License Type',
                    'description' => 'License Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Location Type',
                    'description' => 'Location Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Pedagogical Type',
                    'description' => 'Pedagogical Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Physical Location Type',
                    'description' => 'Physical Location Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Profile Type',
                    'description' => 'Profile Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Publisher Type',
                    'description' => 'Publisher Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Qualification Type',
                    'description' => 'Qualification Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Rating Type',
                    'description' => 'Rating Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Revision Type',
                    'description' => 'Revision Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Risk Type',
                    'description' => 'Risk Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Role Type',
                    'description' => 'Role Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'School Type',
                    'description' => 'School Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Solution Location Type',
                    'description' => 'Solution Location Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Status Type',
                    'description' => 'Status Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Student Cycle Type',
                    'description' => 'Student Cycle Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Study Constraint Type',
                    'description' => 'Study Constraint Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Study Cycle Type',
                    'description' => 'Study Cycle Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Study Type',
                    'description' => 'Study Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'System Use Type',
                    'description' => 'System Use Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Term Cycle Type',
                    'description' => 'Term Cycle Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Term Cycle Type',
                    'description' => 'Term Cycle Type'
                ]
        );

        DB::table($table)->insert(
                [
                    'name' => 'Unit Type',
                    'description' => 'Unit Type'
                ]
        );


        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
