<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_topbar_ad',
        'home_topbar_ad_url',
        'home_topbar_ad_status',
        'home_middle_ad',
        'home_middle_ad_url',
        'home_middle_ad_status',
        'view_page_ad',
        'view_page_ad_url',
        'view_page_ad_status',
        'news_page_ad',
        'news_page_ad_url',
        'news_page_ad_status',
        'sidebar_ad',
        'sidebar_ad_url',
        'sidebar_ad_status',
    ];
}
