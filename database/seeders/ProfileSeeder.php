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
            'company_name' => 'CoreBiz Solutions',
            'hero_title' => 'Building Digital Solutions For Your Business',
            'hero_subtitle' => 'We are a team of talented designers making websites with modern technologies. Our focus is on driving results and ensuring your digital presence stands out in a crowded market.',
            'about_text' => 'We started with a simple idea: to provide high-quality digital solutions to businesses of all sizes. Over the years, we have grown into a full-service agency, helping our clients navigate the complex world of digital transformation. Our core values remain the same: integrity, innovation, and a relentless focus on client success. We believe that technology should empower people, not complicate their lives.',
            'mission_statement' => 'To deliver innovative and robust digital solutions that empower businesses to scale securely and efficiently in the modern web era.',
            'vision_statement' => 'To be recognized globally as the most reliable technology partner for startups and enterprises, shaping the future of digital interactions.',
            'address' => '123 Business Avenue, Tech District, City 10001',
            'phone' => '+1 (555) 123-4567',
            'email' => 'contact@corebiz.com',
            'facebook_url' => 'https://facebook.com',
            'linkedin_url' => 'https://linkedin.com',
            'instagram_url' => 'https://instagram.com',
            'meta_title' => 'CoreBiz Solutions - Premium Web Development Agency',
            'meta_description' => 'We offer top-notch web development, digital marketing, and UI/UX design services to help your business grow.',
            'meta_keywords' => 'web development, digital marketing, seo, business, startup',
            'footer_text' => '© 2026 CoreBiz Solutions. All Rights Reserved.',
        ]);
    }
}
