<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Advertisement::updateOrCreate(
            ['id' => 1],
            [
                'home_topbar_ad' => 'test',
                'home_topbar_ad_url' => 'test',
                'home_topbar_ad_status' => '1',
                'home_middle_ad' => 'test',
                'home_middle_ad_url' => 'test',
                'home_middle_ad_status' => '1',
                'view_page_ad' => 'test',
                'view_page_ad_url' => 'test',
                'view_page_ad_status' => '1',
                'news_page_ad' => 'test',
                'news_page_ad_url' => 'test',
                'news_page_ad_status' => '1',
                'sidebar_ad' => 'test',
                'sidebar_ad_url' => 'test',
                'sidebar_ad_status' => '1',
            ]
        );
    }
}
