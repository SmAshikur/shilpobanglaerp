<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\TeamMember::create([
            'name' => 'Alex Johnson',
            'position' => 'CEO & Founder',
            'image' => 'images/team/member1.png',
            'facebook_url' => 'https://facebook.com',
            'linkedin_url' => 'https://linkedin.com',
        ]);
        \App\Models\TeamMember::create([
            'name' => 'Sarah Smith',
            'position' => 'Lead Designer',
            'image' => 'images/team/member2.png',
            'facebook_url' => 'https://facebook.com',
            'linkedin_url' => 'https://linkedin.com',
        ]);
        \App\Models\TeamMember::create([
            'name' => 'Michael Chen',
            'position' => 'Technical Director',
            'image' => 'images/team/member1.png',
            'facebook_url' => 'https://facebook.com',
            'linkedin_url' => 'https://linkedin.com',
        ]);
    }
}
