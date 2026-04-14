<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $event1 = \App\Models\Event::create([
            'title' => 'Annual Corporate Picnic 2024',
            'description' => 'A wonderful day out with the entire team at the lakeside resort.',
            'thumbnail' => 'images/hero-bg.png',
            'event_date' => '2024-03-15',
        ]);

        $event1->media()->createMany([
            ['type' => 'image', 'path' => 'images/hero-bg.png', 'title' => 'Team Activity'],
            ['type' => 'image', 'path' => 'images/hero-bg.png', 'title' => 'Award Ceremony'],
            ['type' => 'youtube', 'path' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'title' => 'Highlights Video'],
        ]);

        $event2 = \App\Models\Event::create([
            'title' => 'New Office Opening',
            'description' => 'Celebrating our move to the new state-of-the-art facility in Silicon Valley.',
            'thumbnail' => 'images/hero-bg.png',
            'event_date' => '2023-12-01',
        ]);

        $event2->media()->createMany([
            ['type' => 'image', 'path' => 'images/hero-bg.png', 'title' => 'Ribbon Cutting'],
            ['type' => 'image', 'path' => 'images/hero-bg.png', 'title' => 'Office Interior'],
            ['type' => 'youtube', 'path' => 'https://www.youtube.com/embed/ScMzIvxBSi4', 'title' => 'Facility Tour'],
        ]);
    }
}
