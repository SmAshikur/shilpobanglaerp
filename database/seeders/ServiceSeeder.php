<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Service::create([
            'title' => 'Web Design',
            'description' => 'Beautiful and responsive websites tailored for your business needs.',
            'icon' => 'globe',
        ]);
        \App\Models\Service::create([
            'title' => 'SEO Optimization',
            'description' => 'Boost your search rankings and drive more organic traffic to your site.',
            'icon' => 'search',
        ]);
        \App\Models\Service::create([
            'title' => 'Digital Marketing',
            'description' => 'Strategic marketing campaigns to grow your brand and reach new customers.',
            'icon' => 'trending-up',
        ]);
    }
}
