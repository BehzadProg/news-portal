<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Models\FooterInfo;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use App\Http\Controllers\Controller;

class FooterInfoController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::where('status' , 1)->get();
        return view('admin.footer-info.index' , compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //  dd($request->all());
         $request->validate([
            'logo' => 'nullable|image|max:3000',
            'description' => 'required|max:300',
            'copyright' => 'required|max:255',
        ]);

        $footerInfo = FooterInfo::where('language' , $request->lang)->first();
        $logoPath = $this->handleUpload('logo' , $footerInfo , env('SITE_LOGO_IMAGE_UPLOAD_PATH') , 'footer_logo');
        $footerInfo =  !empty($footerInfo->logo) ? $footerInfo->logo : null;
        FooterInfo::updateOrCreate(
            ['language' => $request->lang],
            [
                'logo' => !empty($logoPath) ? $logoPath : $footerInfo,
                'description' => $request->description,
                'copyright' => $request->copyright,
                'language' => $request->lang
            ]
        );

        toast()->success(__('Updated Successfully'));
        return redirect()->back();
    }

}
