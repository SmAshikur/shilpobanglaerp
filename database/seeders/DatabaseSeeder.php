<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->call([
            CompanySeeder::class,
            SectionSettingSeeder::class,
            ProfileSeeder::class,
            ServiceSeeder::class,
            TeamSeeder::class,
            ReviewSeeder::class,
            PortfolioSeeder::class,
            EventSeeder::class,
        ]);
    }
}
