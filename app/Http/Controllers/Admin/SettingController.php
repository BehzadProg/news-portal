<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    use FileUploadTrait;

    public function index(){
        return view('admin.setting.index');
    }

    public function genralSettingUpdate(Request $request)
    {
        $request->validate([
            'site_logo' => 'nullable|image|max:3000',
            'site_favicon' => 'nullable|image|max:1000',
        ]);

        $site_logo = $this->handleUploadSettingLogo('site_logo' , getSetting('site_logo') , env('SITE_LOGO_IMAGE_UPLOAD_PATH') , 'site_logo');
        $site_favicon = $this->handleUploadSettingLogo('site_favicon' , getSetting('site_favicon'), env('SITE_LOGO_IMAGE_UPLOAD_PATH') , 'site_favicon');

        if(!empty($site_logo)){

            Setting::updateOrCreate(
                ['key' => 'site_logo'],
                ['value' => $site_logo]
            );
        }
        if(!empty($site_favicon)){

            Setting::updateOrCreate(
                ['key' => 'site_favicon'],
                ['value' => $site_favicon]
            );
        }

        toast(__('Updated Successfully') , 'success');
        return redirect()->back();
    }

    public function SeoSettingUpdate(Request $request) : RedirectResponse
    {
        $request->validate([
            'site_seo_title' => 'required|max:60',
            'site_seo_description' => 'required|max:160',
            'site_seo_keywords' => 'required',
        ]);

        Setting::updateOrCreate(
            ['key' => 'site_seo_title'],
            ['value' => $request->site_seo_title]
        );

        Setting::updateOrCreate(
            ['key' => 'site_seo_description'],
            ['value' => $request->site_seo_description]
        );

        Setting::updateOrCreate(
            ['key' => 'site_seo_keywords'],
            ['value' => $request->site_seo_keywords]
        );

        toast(__('Updated Successfully') , 'success');
        return redirect()->back();
    }

    public function appearanceSetting(Request $request) : RedirectResponse
    {
        $request->validate([
            'site_color' => 'required|max:20',
        ]);

        Setting::updateOrCreate(
            ['key' => 'site_color'],
            ['value' => $request->site_color]
        );

        toast(__('Updated Successfully') , 'success');
        return redirect()->back();
    }

    public function changeViewList(Request $request)
    {
        Session::put('setting_list_style', $request->style);
    }
}
