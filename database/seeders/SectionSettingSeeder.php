<?php

namespace Database\Seeders;

use App\Models\SectionSetting;
use Illuminate\Database\Seeder;

class SectionSettingSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            [
                'key' => 'hero',
                'title' => 'Innovative Solutions for Your Business',
                'description' => 'We provide top-notch services to help you grow and succeed in the digital world.',
                'is_visible' => true,
            ],
            [
                'key' => 'about',
                'title' => 'About Our Journey',
                'description' => 'Learn more about our mission, vision, and the values that drive us.',
                'is_visible' => true,
            ],
            [
                'key' => 'services',
                'title' => 'Our Premium Services',
                'description' => 'Explore the wide range of specialized services we offer to our clients.',
                'is_visible' => true,
            ],
            [
                'key' => 'team',
                'title' => 'Meet Our Experts',
                'description' => 'Our team of dedicated professionals is here to support your success.',
                'is_visible' => true,
            ],
            [
                'key' => 'portfolio',
                'title' => 'Our Creative Portfolio',
                'description' => 'A showcase of our most successful and impactful projects.',
                'is_visible' => true,
            ],
            [
                'key' => 'reviews',
                'title' => 'Client Testimonials',
                'description' => 'What our clients say about their experience working with us.',
                'is_visible' => true,
            ],
            [
                'key' => 'events',
                'title' => 'Latest Events & Highlights',
                'description' => 'Stay updated with our recent activities, workshops, and milestones.',
                'is_visible' => true,
            ],
            [
                'key' => 'contact',
                'title' => 'Get In Touch',
                'description' => 'Have a project in mind? Contact us today to discuss your ideas.',
                'is_visible' => true,
            ],
        ];

        foreach ($sections as $section) {
            SectionSetting::updateOrCreate(['key' => $section['key']], $section);
        }
    }
}
