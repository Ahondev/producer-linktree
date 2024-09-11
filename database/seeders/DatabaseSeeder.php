<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Project;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        (new UserSeeder())->run();
        (new CampaignSeeder())->run();
        (new ImageSeeder())->run();
    }

}
