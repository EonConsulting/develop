<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $this->call(AccessTypeSeeder::class);
        $this->command->info('lk_access_type table seeded!');

        $this->call(ApplicationTypeSeeder::class);
        $this->command->info('lk_application_type table seeded!');

        $this->call(BureauTypeSeeder::class);
        $this->command->info('lk_bureau_type table seeded!');

        $this->call(CentreTypeSeeder::class);
        $this->command->info('lk_centre_type table seeded!');

        $this->call(ChairTypeSeeder::class);
        $this->command->info('lk_chair_type table seeded!');

        $this->call(CollaborationTypeSeeder::class);
        $this->command->info('lk_collaboration_type table seeded!');

        $this->call(CollegeTypeSeeder::class);
        $this->command->info('lk_college_type table seeded!');

        $this->call(ComponentFunctionalTypeSeeder::class);
        $this->command->info('lk_component_functional_type table seeded!');

        $this->call(ConcernTypeSeeder::class);
        $this->command->info('lk_concern_type table seeded!');

        $this->call(ContentDifficultyTypeSeeder::class);
        $this->command->info('lk_content_difficulty_type table seeded!');

        $this->call(ContentInfoTypeSeeder::class);
        $this->command->info('lk_content_info_type table seeded!');

        $this->call(ContentProgressTypeSeeder::class);
        $this->command->info('lk_content_progress_type table seeded!');

        $this->call(ContentTagTypeSeeder::class);
        $this->command->info('lk_content_tag_type table seeded!');

        $this->call(ContentTypeSeeder::class);
        $this->command->info('lk_content_type table seeded!');

        $this->call(ContentUsageTypeSeeder::class);
        $this->command->info('lk_content_usage_type table seeded!');

        $this->call(ContributorTypeSeeder::class);
        $this->command->info('lk_contributor_type table seeded!');

        $this->call(CostingTypeSeeder::class);
        $this->command->info('lk_costing_type table seeded!');

        $this->call(CoverageTypeSeeder::class);
        $this->command->info('lk_coverage_type table seeded!');

        $this->call(DateTimeTypeSeeder::class);
        $this->command->info('lk_date_time_type table seeded!');

        $this->call(DepartmentTypeSeeder::class);
        $this->command->info('lk_department_type table seeded!');

        $this->call(DisciplineTypeSeeder::class);
        $this->command->info('lk_discipline_type table seeded!');

        $this->call(DistributionTypeSeeder::class);
        $this->command->info('lk_distribution_type table seeded!');

        $this->call(EnrolmentTypeSeeder::class);
        $this->command->info('lk_enrolment_type table seeded!');

        $this->call(ExpirationTypeSeeder::class);
        $this->command->info('lk_expiration_type table seeded!');

        $this->call(GoalTypeSeeder::class);
        $this->command->info('lk_goal_type table seeded!');

        $this->call(InstituteTypeSeeder::class);
        $this->command->info('lk_institute_type table seeded!');

        $this->call(InstitutionTypeSeeder::class);
        $this->command->info('lk_institution_type table seeded!');

        $this->call(InterestTypeSeeder::class);
        $this->command->info('lk_interest_type table seeded!');

        $this->call(LicenseTypeSeeder::class);
        $this->command->info('lk_license_type table seeded!');

        $this->call(LocationTypeSeeder::class);
        $this->command->info('lk_location_type table seeded!');

        $this->call(OfficeTypeSeeder::class);
        $this->command->info('lk_office_type table seeded!');

        $this->call(PedagogicalTypeSeeder::class);
        $this->command->info('lk_pedagogical_type table seeded!');

        $this->call(PhysicalLocationTypeSeeder::class);
        $this->command->info('lk_physical_location_type table seeded!');

        $this->call(ProfileTypeSeeder::class);
        $this->command->info('lk_profile_type table seeded!');

        $this->call(PublisherTypeSeeder::class);
        $this->command->info('lk_publisher_type table seeded!');

        $this->call(QualificationTypeSeeder::class);
        $this->command->info('lk_qualification_type table seeded!');

        $this->call(RatingTypeSeeder::class);
        $this->command->info('lk_rating_type table seeded!');

        $this->call(RevisionTypeSeeder::class);
        $this->command->info('lk_revision_type table seeded!');

        $this->call(RiskTypeSeeder::class);
        $this->command->info('lk_risk_type table seeded!');

        $this->call(RoleTypeSeeder::class);
        $this->command->info('lk_role_type table seeded!');

        $this->call(SchoolTypeSeeder::class);
        $this->command->info('lk_school_type table seeded!');

        $this->call(SolutionLocationTypeSeeder::class);
        $this->command->info('lk_solution_location_type table seeded!');

        $this->call(StatusTypeSeeder::class);
        $this->command->info('lk_status_type table seeded!');

        $this->call(StudentCycleTypeSeeder::class);
        $this->command->info('lk_student_cycle_type table seeded!');

        $this->call(StudyConstraintTypeSeeder::class);
        $this->command->info('lk_study_constraint_type table seeded!');

        $this->call(StudyCycleTypeSeeder::class);
        $this->command->info('lk_study_cycle_type table seeded!');

        $this->call(StudyTypeSeeder::class);
        $this->command->info('lk_study_type table seeded!');

        $this->call(SystemUseTypeSeeder::class);
        $this->command->info('lk_system_use_type table seeded!');

        $this->call(TermCycleTypeSeeder::class);
        $this->command->info('lk_term_cycle_type table seeded!');

        $this->call(UnitTypeSeeder::class);
        $this->command->info('lk_unit_type table seeded!');
    }
}
