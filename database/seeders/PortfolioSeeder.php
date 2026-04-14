<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $webId = \App\Models\Service::where('title', 'like', '%Web%')->first()?->id ?? 1;
        $seoId = \App\Models\Service::where('title', 'like', '%SEO%')->first()?->id ?? 2;
        $marketingId = \App\Models\Service::where('title', 'like', '%Marketing%')->first()?->id ?? 3;

        \App\Models\Portfolio::create([
            'title' => 'E-Commerce Platform',
            'description' => 'A full-featured online store for a fashion brand.',
            'service_id' => $webId,
            'image' => 'images/hero-bg.png',
        ]);

        \App\Models\Portfolio::create([
            'title' => 'Corporate Website',
            'description' => 'A clean and professional website for a law firm.',
            'service_id' => $webId,
            'image' => 'images/hero-bg.png',
        ]);

        \App\Models\Portfolio::create([
            'title' => 'Growth Hack SEO',
            'description' => 'Increased organic traffic by 200% in 6 months.',
            'service_id' => $seoId,
            'image' => 'images/hero-bg.png',
        ]);

        \App\Models\Portfolio::create([
            'title' => 'Social Media Blitz',
            'description' => 'Viral campaign that reached over 1M users.',
            'service_id' => $marketingId,
            'image' => 'images/hero-bg.png',
        ]);
    }
}
