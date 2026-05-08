<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Company::updateOrCreate(
            ['email' => 'info@shilpobangla.com'],
            [
                'name' => 'Shilpobangla ERP',
                'phone' => '01700000000',
                'address' => 'Dhaka, Bangladesh',
                'is_mother' => true,
                'is_active' => true,
                'type' => 'mother'
            ]
        );
    }
}
