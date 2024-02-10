<?php

namespace Database\Seeders;

use App\Models\FooterInfo;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FooterInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FooterInfo::updateOrCreate(
            ['language' => 'en'],
            [
                'logo' => '/test',
                'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eius magnam harum iure officia laudantium impedit voluptatem.',
                'copyright' => 'Copyright © 2023 Top News Theme by Behzad',
            ]
        );
    }
}
