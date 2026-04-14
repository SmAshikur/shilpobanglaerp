<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Review::create([
            'client_name' => 'John Doe',
            'client_designation' => 'CEO, TechCorp',
            'review_text' => 'Dynamic Solutions transformed our business presence completely. Their attention to detail is unmatched!',
            'rating' => 5,
        ]);
        \App\Models\Review::create([
            'client_name' => 'Jane Smith',
            'client_designation' => 'Founder, Startup Hub',
            'review_text' => 'Fast, reliable, and modern. We couldn\'t be happier with our new business profile!',
            'rating' => 5,
        ]);
    }
}
