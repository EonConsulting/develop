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
        $this->call(ContentTemplatesSeeder::class);
        $this->command->info('content_templates table seeded!');
    }
}
