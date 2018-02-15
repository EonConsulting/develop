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
        $this->call(MetadataTypeSeeder::class);
        $this->command->info('metadata_type table seeded!');
        $this->call(MetadataStoreSeeder::class);
        $this->command->info('metadata_store table seeded!');
        $this->call(PopulateIntegrationAndAnalyticsSeeder::class);
        $this->command->info('populated integration and analytics tables!');
    }
}
