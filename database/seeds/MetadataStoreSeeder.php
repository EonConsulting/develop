<?php

use Illuminate\Database\Seeder;

class MetadataStoreSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $table = "metadata_store";

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table($table)->truncate();

        // access type --------------------------------------------------->
        $metadata_type_id = "Access Type";
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 1,
                    'description' => 'Internal Use',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 1,
                    'description' => 'Open to public',
                    'sequence' => 2
                ]
        );

        // application type --------------------------------------------------->
        $metadata_type_id = "Application Type";
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 2,
                    'description' => 'Self-Study',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 2,
                    'description' => 'Course based',
                    'sequence' => 1
                ]
        );

        // bureau type --------------------------------------------------->
        $metadata_type_id = "Bureau Type";
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 3,
                    'description' => 'Bureau of Market Research',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 3,
                    'description' => 'SA Business Review',
                    'sequence' => 2
                ]
        );

        // centre type --------------------------------------------------->
        $metadata_type_id = "Centre Type";
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 4,
                    'description' => 'Centre for Accounting Studies',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 4,
                    'description' => 'Centre for Sustainable Agriculture and Environmental Sciences',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 4,
                    'description' => 'Centre for Business Management',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 4,
                    'description' => 'Centre for Decision Sciences',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 4,
                    'description' => 'Centre for Transport Economics, Logistics and Tourism',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 4,
                    'description' => 'Centre for Continuing Education and Training',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 4,
                    'description' => 'Centre for Applied Information and Communication',
                    'sequence' => 7
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 4,
                    'description' => 'Centre for Applied Psychology',
                    'sequence' => 8
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 4,
                    'description' => 'Centre for Pan African Languages and Cultural Development',
                    'sequence' => 9
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 4,
                    'description' => 'Khanokhulu Centre',
                    'sequence' => 10
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 4,
                    'description' => 'The John Povey Centre for the Study of English in Southern Africa',
                    'sequence' => 11
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 4,
                    'description' => 'Tirisano Centre',
                    'sequence' => 12
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 4,
                    'description' => 'Centre for Basic Legal Education',
                    'sequence' => 13
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 4,
                    'description' => 'Centre for Business Law',
                    'sequence' => 14
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 4,
                    'description' => 'Centre for Criminological Sciences',
                    'sequence' => 15
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 4,
                    'description' => 'Centre for Foreign and Comparative Law',
                    'sequence' => 16
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 4,
                    'description' => 'Centre for Public Law Studies',
                    'sequence' => 17
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 4,
                    'description' => 'Centre for Software Engineering (CENSE)',
                    'sequence' => 18
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 4,
                    'description' => 'Centre for Industrial and Organisational Psychology',
                    'sequence' => 19
                ]
        );

        // chair type --------------------------------------------------->
        $metadata_type_id = "Chair Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 5,
                    'description' => 'South African Research Chair in Development Education',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 5,
                    'description' => 'South African Research Chair in Social Policy',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 5,
                    'description' => 'Unesco - Unisa Africa Chair in nanoscience and nanotechnology',
                    'sequence' => 3
                ]
        );

        // collaboration type --------------------------------------------------->
        $metadata_type_id = "Collaboration Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 6,
                    'description' => 'Student-to-student',
                    'sequence' => 7
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 6,
                    'description' => 'Student-to-lecturer',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 6,
                    'description' => 'Student-to-group',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 6,
                    'description' => 'Student-to-content',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 6,
                    'description' => 'Lecturer-to-lecturer',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 6,
                    'description' => 'Lecturer-to-group',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 6,
                    'description' => 'Lecturer-to-content',
                    'sequence' => 1
                ]
        );

        // college type --------------------------------------------------->
        $metadata_type_id = "College Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 7,
                    'description' => 'Accounting Sciences',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 7,
                    'description' => 'Agriculture and Environmental Sciences',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 7,
                    'description' => 'Economic and Management Sciences',
                    'sequence' => 3
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 7,
                    'description' => 'Education',
                    'sequence' => 4
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 7,
                    'description' => 'Human Sciences',
                    'sequence' => 6
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 7,
                    'description' => 'Law',
                    'sequence' => 7
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 7,
                    'description' => 'Science, Engineering and Technology',
                    'sequence' => 8
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 7,
                    'description' => 'Graduate Studies',
                    'sequence' => 5
                ]
        );

        // component functional type --------------------------------------------------->
        $metadata_type_id = "Component Functional Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 8,
                    'description' => 'Analytics',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 8,
                    'description' => 'Study aid (help)',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 8,
                    'description' => 'Assessment',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 8,
                    'description' => 'Content',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 8,
                    'description' => 'Media',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 8,
                    'description' => 'Dashboard',
                    'sequence' => 4
                ]
        );

        // concern type --------------------------------------------------->
        $metadata_type_id = "Concern Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 9,
                    'description' => 'Reliability',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 9,
                    'description' => 'Usability',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 9,
                    'description' => 'Responsiveness',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 9,
                    'description' => 'Security',
                    'sequence' => 4
                ]
        );

        // content difficulty type --------------------------------------------------->
        $metadata_type_id = "Content Difficulty Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 10,
                    'description' => 'Easy',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 10,
                    'description' => 'Moderate',
                    'sequence' => 4
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 10,
                    'description' => 'Extreme',
                    'sequence' => 3
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 10,
                    'description' => 'Difficult',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 10,
                    'description' => 'Strenuous',
                    'sequence' => 5
                ]
        );

        // content info type --------------------------------------------------->
        $metadata_type_id = "Content Info Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 11,
                    'description' => 'Name',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 11,
                    'description' => 'Description',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 11,
                    'description' => 'UID',
                    'sequence' => 8
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 11,
                    'description' => 'Required',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 11,
                    'description' => 'PID',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 11,
                    'description' => 'Version',
                    'sequence' => 9
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 11,
                    'description' => 'Format',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 11,
                    'description' => 'Source',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 11,
                    'description' => 'Title',
                    'sequence' => 7
                ]
        );

        // content progress type --------------------------------------------------->
        $metadata_type_id = "Content Progress Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 12,
                    'description' => 'No Progress',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 12,
                    'description' => 'Some Progress',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 12,
                    'description' => 'Much Progress',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 12,
                    'description' => 'Excellent Progress',
                    'sequence' => 1
                ]
        );

        // content tag type --------------------------------------------------->
        $metadata_type_id = "Content Tag Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 13,
                    'description' => 'Question',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 13,
                    'description' => 'Important',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 13,
                    'description' => 'Fact',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 13,
                    'description' => 'Remember',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 13,
                    'description' => 'Hint',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 13,
                    'description' => 'Reflection',
                    'sequence' => 5
                ]
        );

        // content usage type --------------------------------------------------->
        $metadata_type_id = "Content Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 14,
                    'description' => 'Learning Content',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 14,
                    'description' => 'Learning Outcomes',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 14,
                    'description' => 'Lecturers voice',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 14,
                    'description' => 'Assessments',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 14,
                    'description' => 'Multimedia',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 14,
                    'description' => 'Textbooks',
                    'sequence' => 8
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 14,
                    'description' => 'Web 2.0',
                    'sequence' => 9
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 14,
                    'description' => 'Feedback',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 14,
                    'description' => 'Reminders',
                    'sequence' => 7
                ]
        );

        // content usage type --------------------------------------------------->
        $metadata_type_id = "Content Usage Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 15,
                    'description' => 'Always',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 15,
                    'description' => 'Often',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 15,
                    'description' => 'Sometimes',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 15,
                    'description' => 'Rarely',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 15,
                    'description' => 'Never',
                    'sequence' => 2
                ]
        );

        // contributor type --------------------------------------------------->
        $metadata_type_id = "Contributor Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 16,
                    'description' => 'System User',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 16,
                    'description' => 'Role Type',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 16,
                    'description' => 'Institution Type',
                    'sequence' => 1
                ]
        );

        // costing type --------------------------------------------------->
        $metadata_type_id = "Costing Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 17,
                    'description' => 'Free',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 17,
                    'description' => 'Subscription',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 17,
                    'description' => 'License Fee',
                    'sequence' => 2
                ]
        );

        // coverage type --------------------------------------------------->
        $metadata_type_id = "Coverage Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 18,
                    'description' => 'Spacial Topic - Geometry (Where)',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 18,
                    'description' => 'Temporal Topic - Synchronization (When)',
                    'sequence' => 2
                ]
        );

        // creator type --------------------------------------------------->
        $metadata_type_id = "Creator Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 19,
                    'description' => 'System User',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 19,
                    'description' => 'Role Type',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 19,
                    'description' => 'Institution Type',
                    'sequence' => 1
                ]
        );

        // datetime type --------------------------------------------------->
        $metadata_type_id = "Date Time Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 20,
                    'description' => 'Date Time Stamp',
                    'sequence' => 1
                ]
        );

        // department type --------------------------------------------------->
        $metadata_type_id = "Department Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Auditing',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Financial Accounting',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Management Accounting',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Taxation',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Financial Governance',
                    'sequence' => 5
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Financial Intelligence',
                    'sequence' => 6
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Agriculture and Animal Health',
                    'sequence' => 7
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Life and Consumer Sciences',
                    'sequence' => 8
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Environmental Sciences',
                    'sequence' => 9
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Geography',
                    'sequence' => 10
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Decision Sciences',
                    'sequence' => 11
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Economics',
                    'sequence' => 12
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Finance, Risk Management and Banking',
                    'sequence' => 13
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Business Management',
                    'sequence' => 14
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Human Resources Management',
                    'sequence' => 15
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Industrial and Organisational Psychology',
                    'sequence' => 16
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Marketing and Retail',
                    'sequence' => 17
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'South African Journal of Labour Relations Management',
                    'sequence' => 18
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Entrepreneurship, Supply Chain, Transport, Tourism and Logistics Management',
                    'sequence' => 19
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Public Administration and Management',
                    'sequence' => 20
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Operations Management',
                    'sequence' => 21
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Adult Basic Education',
                    'sequence' => 22
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Educational Foundations',
                    'sequence' => 23
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Psychology of Education',
                    'sequence' => 24
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Inclusive Education',
                    'sequence' => 25
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Educational Leadership and Management',
                    'sequence' => 26
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Mathematics Education',
                    'sequence' => 27
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Science and Technology Education',
                    'sequence' => 28
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Language Education, Arts and Culture',
                    'sequence' => 29
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Curriculum and Instructional Studies',
                    'sequence' => 30
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Early Childhood Education',
                    'sequence' => 31
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of African Languages',
                    'sequence' => 32
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Afrikaans and Theory of Literature',
                    'sequence' => 33
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Art History, Visual Arts and Musicology',
                    'sequence' => 34
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Communication Science',
                    'sequence' => 35
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of English Studies',
                    'sequence' => 35
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Information Science',
                    'sequence' => 36
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Linguistics and Modern Languages',
                    'sequence' => 37
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Anthropology and Archaeology',
                    'sequence' => 38
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Biblical and Ancient Studies',
                    'sequence' => 39
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Christian Spirituality, Church History and Missiology',
                    'sequence' => 40
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of History',
                    'sequence' => 41
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Philosophy, Practical and Systematic Theology',
                    'sequence' => 42
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Religious Studies and Arabic',
                    'sequence' => 44
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Development Studies',
                    'sequence' => 45
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Health Studies',
                    'sequence' => 46
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Political Sciences',
                    'sequence' => 47
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Psychology',
                    'sequence' => 48
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Social Work',
                    'sequence' => 49
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Sociology',
                    'sequence' => 50
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Criminal and Procedural Law',
                    'sequence' => 51
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Jurisprudence',
                    'sequence' => 52
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Mercantile Law',
                    'sequence' => 53
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Private Law',
                    'sequence' => 54
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Public, Constitutional and International Law',
                    'sequence' => 55
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Criminology and Security Science',
                    'sequence' => 56
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Corrections Management',
                    'sequence' => 57
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Police Practice',
                    'sequence' => 58
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Chemistry',
                    'sequence' => 59
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Mathematical Sciences',
                    'sequence' => 60
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Physics',
                    'sequence' => 61
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Statistics',
                    'sequence' => 62
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Civil and Chemical Engineering',
                    'sequence' => 63
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Mechanical and Industrial Engineering',
                    'sequence' => 64
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Department of Electrical and Mining Engineering',
                    'sequence' => 65
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 21,
                    'description' => 'Postgraduate Administration Department',
                    'sequence' => 66
                ]
        );

        // discipline type --------------------------------------------------->
        $metadata_type_id = "Discipline Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 22,
                    'classification' => "arts",
                    'description' => 'Performing Arts',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 22,
                    'classification' => 'arts',
                    'description' => 'Visual Arts',
                    'sequence' => 2
                ]
        );

        // distribution type --------------------------------------------------->
        $metadata_type_id = "Distribution Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 23,
                    'description' => 'On campus',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 23,
                    'description' => 'Correspondence',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 23,
                    'description' => 'Online',
                    'sequence' => 1
                ]
        );

        // duration type --------------------------------------------------->
        $metadata_type_id = "Duration Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 24,
                    'description' => 'Course Duration',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 24,
                    'description' => 'Evaluation Duration',
                    'sequence' => 3
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 24,
                    'description' => 'Certification Duration',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 24,
                    'description' => 'Study Duration',
                    'sequence' => 5
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 24,
                    'description' => 'Online Interaction Duration',
                    'sequence' => 4
                ]
        );

        // enrolment type --------------------------------------------------->
        $metadata_type_id = "Enrolment Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 25,
                    'description' => 'Full-time',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 25,
                    'description' => 'Part-time',
                    'sequence' => 2
                ]
        );

        // expiration type --------------------------------------------------->
        $metadata_type_id = "Expiration Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 26,
                    'description' => 'Time Cycle',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 26,
                    'description' => 'Event',
                    'sequence' => 1
                ]
        );

        // goal type --------------------------------------------------->
        $metadata_type_id = "Goal Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 27,
                    'description' => 'Professional Qualification',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 27,
                    'description' => 'Certification',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 27,
                    'description' => 'Continued Education',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 27,
                    'description' => 'Research',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 27,
                    'description' => 'Professional Registration ',
                    'sequence' => 5
                ]
        );

        // institute type --------------------------------------------------->
        $metadata_type_id = "Institute Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 28,
                    'description' => 'Institute of Gender Studies',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 28,
                    'description' => 'Research Institute for Theology and Religion',
                    'sequence' => 8
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 28,
                    'description' => 'WIPHOLD-Brigalia Ban Chair in Electoral Democracy in Africa',
                    'sequence' => 9
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 28,
                    'description' => 'Institute for Dispute Resolution in Africa (IDRA)',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 28,
                    'description' => 'Archie Mafeje Research Institute (AMRI)',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 28,
                    'description' => 'Institute for African Renaissance Studies (IARS)',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 28,
                    'description' => 'Institute for Open and Distance Learning (IODL)',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 28,
                    'description' => 'Institute for Science and Technology Education (ISTE)',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 28,
                    'description' => 'Institute for Social and Health Studies (ISHS)',
                    'sequence' => 7
                ]
        );

        // institution type --------------------------------------------------->
        $metadata_type_id = "Institution Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 29,
                    'description' => 'Faculty',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 29,
                    'description' => 'School',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 29,
                    'description' => 'Department',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 29,
                    'description' => 'College',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 29,
                    'description' => 'Academy',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 29,
                    'description' => 'Institute',
                    'sequence' => 5
                ]
        );

        // intereset type --------------------------------------------------->
        $metadata_type_id = "Interest Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 30,
                    'description' => 'Course',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 30,
                    'description' => 'Module',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 30,
                    'description' => 'Subject',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 30,
                    'description' => 'Topic',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 30,
                    'description' => 'Idea',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 30,
                    'description' => 'Asset',
                    'sequence' => 1
                ]
        );

        // license type --------------------------------------------------->
        $metadata_type_id = "License Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 31,
                    'description' => 'OSI approved Open Source',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 31,
                    'description' => 'Public Domain',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 31,
                    'description' => 'Creative Commons Attribution',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 31,
                    'description' => 'Commercial',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 31,
                    'description' => 'Unisa specific',
                    'sequence' => 5
                ]
        );

        // location type --------------------------------------------------->
        $metadata_type_id = "Location Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 32,
                    'description' => 'International students',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 32,
                    'description' => 'RSA students',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 32,
                    'description' => 'Location bound students',
                    'sequence' => 1
                ]
        );

        // pedagogical type --------------------------------------------------->
        $metadata_type_id = "Pedagogical Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 33,
                    'description' => 'Outcome Based',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 33,
                    'description' => 'Schedule Based',
                    'sequence' => 3
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 33,
                    'description' => 'Content Based',
                    'sequence' => 1
                ]
        );

        // physical location type --------------------------------------------------->
        $metadata_type_id = "Physical Location Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 34,
                    'description' => 'Physical Address',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 34,
                    'description' => 'GPS Coordinates',
                    'sequence' => 1
                ]
        );

        // profile type --------------------------------------------------->
        $metadata_type_id = "Profile Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 35,
                    'description' => 'Language',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 35,
                    'description' => 'Ethnicity',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 35,
                    'description' => 'Race',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 35,
                    'description' => 'Sex',
                    'sequence' => 7
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 35,
                    'description' => 'Date-of-birth',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 35,
                    'description' => 'Autonomous',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 35,
                    'description' => 'Nationality',
                    'sequence' => 5
                ]
        );

        // publisher type --------------------------------------------------->
        $metadata_type_id = "Publisher Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 36,
                    'description' => 'System User',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 36,
                    'description' => 'Role Type',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 36,
                    'description' => 'Institution Type',
                    'sequence' => 1
                ]
        );

        // qualification type --------------------------------------------------->
        $metadata_type_id = "Qualification Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 37,
                    'description' => 'Certificate',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 37,
                    'description' => 'Diploma',
                    'sequence' => 3
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 37,
                    'description' => 'Degree',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 37,
                    'description' => 'Honours Degree',
                    'sequence' => 5
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 37,
                    'description' => 'Masters Degree',
                    'sequence' => 6
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 37,
                    'description' => 'Doctoral Degree',
                    'sequence' => 4
                ]
        );

        // rating type --------------------------------------------------->
        $metadata_type_id = "Rating Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 38,
                    'classification' => 'Popularity',
                    'description' => 'Always',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 38,
                    'classification' => 'Popularity',
                    'description' => 'Often',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 38,
                    'classification' => 'Popularity',
                    'description' => 'Sometimes',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 38,
                    'classification' => 'Popularity',
                    'description' => 'Rarely',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 38,
                    'classification' => 'Popularity',
                    'description' => 'Never',
                    'sequence' => 2
                ]
        );

        // revision type --------------------------------------------------->
        $metadata_type_id = "Revision Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 39,
                    'description' => 'Planning',
                    'sequence' => 5
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 39,
                    'description' => 'Pre-Alpha',
                    'sequence' => 6
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 39,
                    'description' => 'Alpha',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 39,
                    'description' => 'Beta',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 39,
                    'description' => 'Production',
                    'sequence' => 7
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 39,
                    'description' => 'Mature',
                    'sequence' => 4
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 39,
                    'description' => 'Inactive',
                    'sequence' => 3
                ]
        );

        // risk type --------------------------------------------------->
        $metadata_type_id = "Risk Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 40,
                    'description' => 'System',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 40,
                    'description' => 'Integration',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 40,
                    'description' => '3rd Party Components',
                    'sequence' => 1
                ]
        );

        // role type --------------------------------------------------->
        $metadata_type_id = "Role Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 41,
                    'description' => 'Student',
                    'sequence' => 8
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 41,
                    'description' => 'Lecturer',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 41,
                    'description' => 'Tutor',
                    'sequence' => 10
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 41,
                    'description' => 'Administrator',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 41,
                    'description' => 'Proctor',
                    'sequence' => 7
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 41,
                    'description' => 'Facilitator',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 41,
                    'description' => 'Assistant',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 41,
                    'description' => 'Editor',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 41,
                    'description' => 'Moderator',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 41,
                    'description' => 'Subject Matter Expert',
                    'sequence' => 9
                ]
        );

        // school type --------------------------------------------------->
        $metadata_type_id = "School Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 42,
                    'description' => 'School of Accountancy',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 42,
                    'description' => 'School of Applied Accountancy',
                    'sequence' => 3
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 42,
                    'description' => 'School of Agriculture and Life Sciences',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 42,
                    'description' => 'School of Environmental Sciences',
                    'sequence' => 6
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 42,
                    'description' => 'School of Educational Studies',
                    'sequence' => 5
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 42,
                    'description' => 'School of Teacher Education',
                    'sequence' => 10
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 42,
                    'description' => 'School of Arts',
                    'sequence' => 4
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 42,
                    'description' => 'School of Humanities',
                    'sequence' => 7
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 42,
                    'description' => 'School of Social Sciences',
                    'sequence' => 9
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 42,
                    'description' => 'School of Interdisciplinary Research and Graduate Studies (SIRGS)',
                    'sequence' => 8
                ]
        );

        // solution location type --------------------------------------------------->
        $metadata_type_id = "Solution Location Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 43,
                    'description' => 'Storyline',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 43,
                    'description' => 'Apps repository',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 43,
                    'description' => 'Lecturer Interface',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 43,
                    'description' => 'Student Interface',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 43,
                    'description' => 'Administrator Interface',
                    'sequence' => 1
                ]
        );

        // status type --------------------------------------------------->
        $metadata_type_id = "Status Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 44,
                    'description' => 'Potential student',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 44,
                    'description' => 'Registered student',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 44,
                    'description' => 'Alumni',
                    'sequence' => 1
                ]
        );

        // student cycle type --------------------------------------------------->
        $metadata_type_id = "Student Cycle Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 45,
                    'description' => 'Undergraduate',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 45,
                    'description' => 'Graduate',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 45,
                    'description' => 'Postgraduate',
                    'sequence' => 2
                ]
        );

        // study constraint type --------------------------------------------------->
        $metadata_type_id = "Study Constraint Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 46,
                    'description' => 'Time',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 46,
                    'description' => 'Money',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 46,
                    'description' => 'Technology',
                    'sequence' => 2
                ]
        );

        // study constraint type --------------------------------------------------->
        $metadata_type_id = "Study Cycle Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 47,
                    'description' => 'Application',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 47,
                    'description' => 'Admittance',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 47,
                    'description' => 'Registration',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 47,
                    'description' => 'Study',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 47,
                    'description' => 'Examination',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 47,
                    'description' => 'Graduation',
                    'sequence' => 4
                ]
        );

        // study type --------------------------------------------------->
        $metadata_type_id = "Study Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 48,
                    'description' => 'Revision',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 48,
                    'description' => '1st registration',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 48,
                    'description' => 'Repeat Student',
                    'sequence' => 2
                ]
        );

        // system use type --------------------------------------------------->
        $metadata_type_id = "System Use Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 49,
                    'description' => 'Front end use',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 49,
                    'description' => 'Back end use',
                    'sequence' => 1
                ]
        );

        // term cycle type --------------------------------------------------->
        $metadata_type_id = "Term Cycle Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 50,
                    'description' => '1st Term',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 50,
                    'description' => '2nd Term',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 50,
                    'description' => '3rd Term',
                    'sequence' => 3
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 50,
                    'description' => '4th Term',
                    'sequence' => 4
                ]
        );

        // unit type --------------------------------------------------->
        $metadata_type_id = "Unit Type";

        DB::table($table)->insert(
                [
                    'metadata_type_id' => 51,
                    'description' => 'Applied Behavioural Ecology and Ecosystem Research Unit',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 51,
                    'description' => 'Anthropology and Archaeology Museum',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 51,
                    'description' => 'African Languages Literary Information Museum',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 51,
                    'description' => 'Unisa Art Gallery',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type_id' => 51,
                    'description' => 'Unisa Law Clinic',
                    'sequence' => 5
                ]
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
