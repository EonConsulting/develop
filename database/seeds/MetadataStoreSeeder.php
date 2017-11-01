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
        $metadata_type = "Access Type";
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Internal Use',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Open to public',
                    'sequence' => 2
                ]
        );

        // application type --------------------------------------------------->
        $metadata_type = "Application Type";
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Self-Study',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Course based',
                    'sequence' => 1
                ]
        );

        // bureau type --------------------------------------------------->
        $metadata_type = "Bureau Type";
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Bureau of Market Research',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'SA Business Review',
                    'sequence' => 2
                ]
        );

        // centre type --------------------------------------------------->
        $metadata_type = "Centre Type";
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Centre for Accounting Studies',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Centre for Sustainable Agriculture and Environmental Sciences',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Centre for Business Management',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Centre for Decision Sciences',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Centre for Transport Economics, Logistics and Tourism',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Centre for Continuing Education and Training',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Centre for Applied Information and Communication',
                    'sequence' => 7
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Centre for Applied Psychology',
                    'sequence' => 8
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Centre for Pan African Languages and Cultural Development',
                    'sequence' => 9
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Khanokhulu Centre',
                    'sequence' => 10
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'The John Povey Centre for the Study of English in Southern Africa',
                    'sequence' => 11
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Tirisano Centre',
                    'sequence' => 12
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Centre for Basic Legal Education',
                    'sequence' => 13
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Centre for Business Law',
                    'sequence' => 14
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Centre for Criminological Sciences',
                    'sequence' => 15
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Centre for Foreign and Comparative Law',
                    'sequence' => 16
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Centre for Public Law Studies',
                    'sequence' => 17
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Centre for Software Engineering (CENSE)',
                    'sequence' => 18
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Centre for Industrial and Organisational Psychology',
                    'sequence' => 19
                ]
        );

        // chair type --------------------------------------------------->
        $metadata_type = "Chair Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'South African Research Chair in Development Education',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'South African Research Chair in Social Policy',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Unesco - Unisa Africa Chair in nanoscience and nanotechnology',
                    'sequence' => 3
                ]
        );

        // collaboration type --------------------------------------------------->
        $metadata_type = "Collaboration Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Student-to-student',
                    'sequence' => 7
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Student-to-lecturer',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Student-to-group',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Student-to-content',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Lecturer-to-lecturer',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Lecturer-to-group',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Lecturer-to-content',
                    'sequence' => 1
                ]
        );

        // college type --------------------------------------------------->
        $metadata_type = "College Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Accounting Sciences',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Agriculture and Environmental Sciences',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Economic and Management Sciences',
                    'sequence' => 3
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Education',
                    'sequence' => 4
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Human Sciences',
                    'sequence' => 6
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Law',
                    'sequence' => 7
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Science, Engineering and Technology',
                    'sequence' => 8
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Graduate Studies',
                    'sequence' => 5
                ]
        );

        // component functional type --------------------------------------------------->
        $metadata_type = "Component Functional Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Analytics',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Study aid (help)',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Assessment',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Content',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Media',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Dashboard',
                    'sequence' => 4
                ]
        );

        // concern type --------------------------------------------------->
        $metadata_type = "Concern Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Reliability',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Usability',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Responsiveness',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Security',
                    'sequence' => 4
                ]
        );

        // content difficulty type --------------------------------------------------->
        $metadata_type = "Content Difficulty Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Easy',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Moderate',
                    'sequence' => 4
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Extreme',
                    'sequence' => 3
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Difficult',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Strenuous',
                    'sequence' => 5
                ]
        );

        // content info type --------------------------------------------------->
        $metadata_type = "Content Info Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Name',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Description',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'UID',
                    'sequence' => 8
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Required',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'PID',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Version',
                    'sequence' => 9
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Format',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Source',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Title',
                    'sequence' => 7
                ]
        );

        // content progress type --------------------------------------------------->
        $metadata_type = "Content Progress Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'No Progress',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Some Progress',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Much Progress',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Excellent Progress',
                    'sequence' => 1
                ]
        );

        // content tag type --------------------------------------------------->
        $metadata_type = "Content Tag Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Question',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Important',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Fact',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Remember',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Hint',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Reflection',
                    'sequence' => 5
                ]
        );

        // content type --------------------------------------------------->
        $metadata_type = "Content Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Learning Content',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Learning Outcomes',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Lecturers voice',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Assessments',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Multimedia',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Textbooks',
                    'sequence' => 8
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Web 2.0',
                    'sequence' => 9
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Feedback',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Reminders',
                    'sequence' => 7
                ]
        );

        // content usage type --------------------------------------------------->
        $metadata_type = "Content Usage Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Always',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Often',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Sometimes',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Rarely',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Never',
                    'sequence' => 2
                ]
        );

        // contributor type --------------------------------------------------->
        $metadata_type = "Contributor Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'System User',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Role Type',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Institution Type',
                    'sequence' => 1
                ]
        );

        // costing type --------------------------------------------------->
        $metadata_type = "Costing Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Free',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Subscription',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'License Fee',
                    'sequence' => 2
                ]
        );

        // coverage type --------------------------------------------------->
        $metadata_type = "Coverage Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Spacial Topic - Geometry (Where)',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Temporal Topic - Synchronization (When)',
                    'sequence' => 2
                ]
        );

        // creator type --------------------------------------------------->
        $metadata_type = "Creator Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'System User',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Role Type',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Institution Type',
                    'sequence' => 1
                ]
        );

        // datetime type --------------------------------------------------->
        $metadata_type = "Date Time Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Date Time Stamp',
                    'sequence' => 1
                ]
        );

        // department type --------------------------------------------------->
        $metadata_type = "Department Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Auditing',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Financial Accounting',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Management Accounting',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Taxation',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Financial Governance',
                    'sequence' => 5
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Financial Intelligence',
                    'sequence' => 6
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Agriculture and Animal Health',
                    'sequence' => 7
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Life and Consumer Sciences',
                    'sequence' => 8
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Environmental Sciences',
                    'sequence' => 9
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Geography',
                    'sequence' => 10
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Decision Sciences',
                    'sequence' => 11
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Economics',
                    'sequence' => 12
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Finance, Risk Management and Banking',
                    'sequence' => 13
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Business Management',
                    'sequence' => 14
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Human Resources Management',
                    'sequence' => 15
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Industrial and Organisational Psychology',
                    'sequence' => 16
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Marketing and Retail',
                    'sequence' => 17
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'South African Journal of Labour Relations Management',
                    'sequence' => 18
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Entrepreneurship, Supply Chain, Transport, Tourism and Logistics Management',
                    'sequence' => 19
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Public Administration and Management',
                    'sequence' => 20
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Operations Management',
                    'sequence' => 21
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Adult Basic Education',
                    'sequence' => 22
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Educational Foundations',
                    'sequence' => 23
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Psychology of Education',
                    'sequence' => 24
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Inclusive Education',
                    'sequence' => 25
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Educational Leadership and Management',
                    'sequence' => 26
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Mathematics Education',
                    'sequence' => 27
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Science and Technology Education',
                    'sequence' => 28
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Language Education, Arts and Culture',
                    'sequence' => 29
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Curriculum and Instructional Studies',
                    'sequence' => 30
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Early Childhood Education',
                    'sequence' => 31
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of African Languages',
                    'sequence' => 32
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Afrikaans and Theory of Literature',
                    'sequence' => 33
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Art History, Visual Arts and Musicology',
                    'sequence' => 34
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Communication Science',
                    'sequence' => 35
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of English Studies',
                    'sequence' => 36
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Information Science',
                    'sequence' => 37
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Linguistics and Modern Languages',
                    'sequence' => 38
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Anthropology and Archaeology',
                    'sequence' => 39
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Biblical and Ancient Studies',
                    'sequence' => 40
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Christian Spirituality, Church History and Missiology',
                    'sequence' => 41
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of History',
                    'sequence' => 42
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Philosophy, Practical and Systematic Theology',
                    'sequence' => 43
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Religious Studies and Arabic',
                    'sequence' => 44
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Development Studies',
                    'sequence' => 45
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Health Studies',
                    'sequence' => 46
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Political Sciences',
                    'sequence' => 47
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Psychology',
                    'sequence' => 48
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Social Work',
                    'sequence' => 49
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Sociology',
                    'sequence' => 50
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Criminal and Procedural Law',
                    'sequence' => 51
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Jurisprudence',
                    'sequence' => 52
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Mercantile Law',
                    'sequence' => 53
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Private Law',
                    'sequence' => 54
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Public, Constitutional and International Law',
                    'sequence' => 55
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Criminology and Security Science',
                    'sequence' => 56
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Corrections Management',
                    'sequence' => 57
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Police Practice',
                    'sequence' => 58
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Chemistry',
                    'sequence' => 59
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Mathematical Sciences',
                    'sequence' => 60
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Physics',
                    'sequence' => 61
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Statistics',
                    'sequence' => 62
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Civil and Chemical Engineering',
                    'sequence' => 63
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Mechanical and Industrial Engineering',
                    'sequence' => 64
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department of Electrical and Mining Engineering',
                    'sequence' => 65
        ]);
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Postgraduate Administration Department',
                    'sequence' => 66
                ]
        );

        // discipline type --------------------------------------------------->
        $metadata_type = "Discipline Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'classification' => "arts",
                    'description' => 'Performing Arts',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'classification' => 'arts',
                    'description' => 'Visual Arts',
                    'sequence' => 2
                ]
        );

        // distribution type --------------------------------------------------->
        $metadata_type = "Distribution Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'On campus',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Correspondence',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Online',
                    'sequence' => 1
                ]
        );

        // duration type --------------------------------------------------->
        $metadata_type = "Duration Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Course Duration',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Evaluation Duration',
                    'sequence' => 3
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Certification Duration',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Study Duration',
                    'sequence' => 5
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Online Interaction Duration',
                    'sequence' => 4
                ]
        );

        // enrolment type --------------------------------------------------->
        $metadata_type = "Enrolment Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Full-time',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Part-time',
                    'sequence' => 2
                ]
        );

        // expiration type --------------------------------------------------->
        $metadata_type = "Expiration Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Time Cycle',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Event',
                    'sequence' => 1
                ]
        );

        // goal type --------------------------------------------------->
        $metadata_type = "Goal Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Professional Qualification',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Certification',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Continued Education',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Research',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Professional Registration ',
                    'sequence' => 5
                ]
        );

        // institute type --------------------------------------------------->
        $metadata_type = "Institute Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Institute of Gender Studies',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Research Institute for Theology and Religion',
                    'sequence' => 8
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'WIPHOLD-Brigalia Ban Chair in Electoral Democracy in Africa',
                    'sequence' => 9
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Institute for Dispute Resolution in Africa (IDRA)',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Archie Mafeje Research Institute (AMRI)',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Institute for African Renaissance Studies (IARS)',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Institute for Open and Distance Learning (IODL)',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Institute for Science and Technology Education (ISTE)',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Institute for Social and Health Studies (ISHS)',
                    'sequence' => 7
                ]
        );

        // institution type --------------------------------------------------->
        $metadata_type = "Institution Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Faculty',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'School',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Department',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'College',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Academy',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Institute',
                    'sequence' => 5
                ]
        );

        // intereset type --------------------------------------------------->
        $metadata_type = "Interest Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Course',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Module',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Subject',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Topic',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Idea',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Asset',
                    'sequence' => 1
                ]
        );

        // license type --------------------------------------------------->
        $metadata_type = "License Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'OSI approved Open Source',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Public Domain',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Creative Commons Attribution',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Commercial',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Unisa specific',
                    'sequence' => 5
                ]
        );

        // location type --------------------------------------------------->
        $metadata_type = "Location Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'International students',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'RSA students',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Location bound students',
                    'sequence' => 1
                ]
        );

        // pedagogical type --------------------------------------------------->
        $metadata_type = "Pedagogical Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Outcome Based',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Schedule Based',
                    'sequence' => 3
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Content Based',
                    'sequence' => 1
                ]
        );

        // physical location type --------------------------------------------------->
        $metadata_type = "Physical Location Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Physical Address',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'GPS Coordinates',
                    'sequence' => 1
                ]
        );

        // profile type --------------------------------------------------->
        $metadata_type = "Profile Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Language',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Ethnicity',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Race',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Sex',
                    'sequence' => 7
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Date-of-birth',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Autonomous',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Nationality',
                    'sequence' => 5
                ]
        );

        // publisher type --------------------------------------------------->
        $metadata_type = "Publisher Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'System User',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Role Type',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Institution Type',
                    'sequence' => 1
                ]
        );

        // qualification type --------------------------------------------------->
        $metadata_type = "Qualification Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Certificate',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Diploma',
                    'sequence' => 3
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Degree',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Honours Degree',
                    'sequence' => 5
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Masters Degree',
                    'sequence' => 6
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Doctoral Degree',
                    'sequence' => 4
                ]
        );

        // rating type --------------------------------------------------->
        $metadata_type = "Rating Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'classification' => 'Popularity',
                    'description' => 'Always',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'classification' => 'Popularity',
                    'description' => 'Often',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'classification' => 'Popularity',
                    'description' => 'Sometimes',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'classification' => 'Popularity',
                    'description' => 'Rarely',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'classification' => 'Popularity',
                    'description' => 'Never',
                    'sequence' => 2
                ]
        );

        // revision type --------------------------------------------------->
        $metadata_type = "Revision Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Planning',
                    'sequence' => 5
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Pre-Alpha',
                    'sequence' => 6
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Alpha',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Beta',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Production',
                    'sequence' => 7
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Mature',
                    'sequence' => 4
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Inactive',
                    'sequence' => 3
                ]
        );

        // risk type --------------------------------------------------->
        $metadata_type = "Risk Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'System',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Integration',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => '3rd Party Components',
                    'sequence' => 1
                ]
        );

        // role type --------------------------------------------------->
        $metadata_type = "Role Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Student',
                    'sequence' => 8
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Lecturer',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Tutor',
                    'sequence' => 10
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Administrator',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Proctor',
                    'sequence' => 7
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Facilitator',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Assistant',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Editor',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Moderator',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Subject Matter Expert',
                    'sequence' => 9
                ]
        );

        // school type --------------------------------------------------->
        $metadata_type = "School Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'School of Accountancy',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'School of Applied Accountancy',
                    'sequence' => 3
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'School of Agriculture and Life Sciences',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'School of Environmental Sciences',
                    'sequence' => 6
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'School of Educational Studies',
                    'sequence' => 5
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'School of Teacher Education',
                    'sequence' => 10
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'School of Arts',
                    'sequence' => 4
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'School of Humanities',
                    'sequence' => 7
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'School of Social Sciences',
                    'sequence' => 9
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'School of Interdisciplinary Research and Graduate Studies (SIRGS)',
                    'sequence' => 8
                ]
        );

        // solution location type --------------------------------------------------->
        $metadata_type = "Solution Location Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Storyline',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Apps repository',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Lecturer Interface',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Student Interface',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Administrator Interface',
                    'sequence' => 1
                ]
        );

        // status type --------------------------------------------------->
        $metadata_type = "Status Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Potential student',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Registered student',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Alumni',
                    'sequence' => 1
                ]
        );

        // student cycle type --------------------------------------------------->
        $metadata_type = "Student Cycle Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Undergraduate',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Graduate',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Postgraduate',
                    'sequence' => 2
                ]
        );

        // study constraint type --------------------------------------------------->
        $metadata_type = "Study Constraint Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Time',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Money',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Technology',
                    'sequence' => 2
                ]
        );

        // study constraint type --------------------------------------------------->
        $metadata_type = "Study Cycle Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Application',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Admittance',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Registration',
                    'sequence' => 5
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Study',
                    'sequence' => 6
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Examination',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Graduation',
                    'sequence' => 4
                ]
        );

        // study type --------------------------------------------------->
        $metadata_type = "Study Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Revision',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => '1st registration',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Repeat Student',
                    'sequence' => 2
                ]
        );

        // system use type --------------------------------------------------->
        $metadata_type = "System Use Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Front end use',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Back end use',
                    'sequence' => 1
                ]
        );

        // term cycle type --------------------------------------------------->
        $metadata_type = "Term Cycle Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => '1st Term',
                    'sequence' => 1
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => '2nd Term',
                    'sequence' => 2
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => '3rd Term',
                    'sequence' => 3
                ]
        );

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => '4th Term',
                    'sequence' => 4
                ]
        );

        // unit type --------------------------------------------------->
        $metadata_type = "Unit Type";

        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Applied Behavioural Ecology and Ecosystem Research Unit',
                    'sequence' => 3
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Anthropology and Archaeology Museum',
                    'sequence' => 2
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'African Languages Literary Information Museum',
                    'sequence' => 1
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Unisa Art Gallery',
                    'sequence' => 4
                ]
        );
        DB::table($table)->insert(
                [
                    'metadata_type' => $metadata_type,
                    'description' => 'Unisa Law Clinic',
                    'sequence' => 5
                ]
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
