<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    use FileUploadTrait;

    public function __construct()
    {
        $this->middleware(['permission:advertisement index,admin'])->only('index');
        $this->middleware(['permission:advertisement update,admin'])->only('update');
    }

    public function index() {
        $ad = Advertisement::first();
        return view('admin.advertisement.index' , compact('ad'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'home_topbar_ad' => 'nullable|image|max:3000',
            'home_topbar_ad_url' => 'nullable|url',
            'home_middle_ad' => 'nullable|image|max:3000',
            'home_middle_ad_url' => 'nullable|url',
            'view_page_ad' => 'nullable|image|max:3000',
            'view_page_ad_url' => 'nullable|url',
            'news_page_ad' => 'nullable|image|max:3000',
            'news_page_ad_url' => 'nullable|url',
            'sidebar_ad' => 'nullable|image|max:3000',
            'sidebar_ad_url' => 'nullable|url',
        ]);

        $ad = Advertisement::first();

        $home_topbar_ad = $this->handleUpload('home_topbar_ad' , $ad , env('AD_IMAGE_UPLOAD_PATH') , 'home_topbar');
        $home_middle_ad = $this->handleUpload('home_middle_ad' , $ad , env('AD_IMAGE_UPLOAD_PATH') , 'home_middle');
        $view_page_ad = $this->handleUpload('view_page_ad' , $ad , env('AD_IMAGE_UPLOAD_PATH') , 'view_page');
        $news_page_ad = $this->handleUpload('news_page_ad' , $ad , env('AD_IMAGE_UPLOAD_PATH') , 'news_page');
        $sidebar_ad = $this->handleUpload('sidebar_ad' , $ad , env('AD_IMAGE_UPLOAD_PATH') , 'sidebar');

        Advertisement::updateOrCreate(
            ['id' => 1],
            [
                'home_topbar_ad' => !empty($home_topbar_ad) ? $home_topbar_ad : $ad->home_topbar_ad,
                'home_topbar_ad_url' => $request->home_topbar_ad_url,
                'home_topbar_ad_status' => $request->home_topbar_ad_status == 1 ? 1 : 0,
                'home_middle_ad' => !empty($home_middle_ad) ? $home_middle_ad : $ad->home_middle_ad,
                'home_middle_ad_url' => $request->home_middle_ad_url,
                'home_middle_ad_status' => $request->home_middle_ad_status == 1 ? 1 : 0,
                'view_page_ad' => !empty($view_page_ad) ? $view_page_ad : $ad->view_page_ad,
                'view_page_ad_url' => $request->view_page_ad_url,
                'view_page_ad_status' => $request->view_page_ad_status == 1 ? 1 : 0,
                'news_page_ad' => !empty($news_page_ad) ? $news_page_ad : $ad->news_page_ad,
                'news_page_ad_url' => $request->news_page_ad_url,
                'news_page_ad_status' => $request->news_page_ad_status == 1 ? 1 : 0,
                'sidebar_ad' => !empty($sidebar_ad) ? $sidebar_ad : $ad->sidebar_ad,
                'sidebar_ad_url' => $request->sidebar_ad_url,
                'sidebar_ad_status' => $request->sidebar_ad_status == 1 ? 1 : 0,
            ]
        );

        toast(__('admin_localize.Updated Successfully') , 'success')->width('400');
        return redirect()->route('admin.advertisement.index');
    }
}
