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
        $this->call(AccessTypeSeeder::class);
        $this->command->info('lk_access_type table seeded!');
        
        $this->call(QualificationTypeSeeder::class);
        $this->command->info('lk_qualification_type table seeded!');
        
        $this->call(ContentDifficultyTypeSeeder::class);
        $this->command->info('lk_content_difficulty_type table seeded!');
        
        $this->call(PedagogicalTypeSeeder::class);
        $this->command->info('lk_pedagogical_type table seeded!');
        
        $this->call(DisciplineTypeSeeder::class);
        $this->command->info('lk_discipline_type table seeded!');
        
        $this->call(DurationTypeSeeder::class);
        $this->command->info('lk_duration_type table seeded!');
        
        $this->call(CollegeTypeSeeder::class);
        $this->command->info('lk_college_type table seeded!');
        
        $this->call(SchoolTypeSeeder::class);
        $this->command->info('lk_school_type table seeded!');
        
        $this->call(DepartmentTypeSeeder::class);
        $this->command->info('lk_department_type table seeded!');
        
        $this->call(CentreTypeSeeder::class);
        $this->command->info('lk_center_type table seeded!');
        
        $this->call(InstituteTypeSeeder::class);
        $this->command->info('lk_institute_type table seeded!');
        
    }
}
