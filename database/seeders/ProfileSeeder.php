<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\ProfileInfo::create([
            'company_name' => 'Dynamic Solutions',
            'hero_title' => 'Building Your Digital Identity',
            'hero_subtitle' => 'We create professional online presence for businesses across the globe.',
            'about_text' => 'We are a team of passionate developers and designers dedicated to helping businesses grow through innovative digital solutions.',
            'address' => '123 Tech Street, Silicon Valley, CA',
            'phone' => '+1 234 567 890',
            'email' => 'contact@dynamicsolutions.com',
            'facebook_url' => 'https://facebook.com/dynamicsolutions',
            'linkedin_url' => 'https://linkedin.com/company/dynamicsolutions',
            'instagram_url' => 'https://instagram.com/dynamicsolutions',
        ]);
    }
}
