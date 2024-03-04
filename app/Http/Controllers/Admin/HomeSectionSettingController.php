<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSectionSetting;
use App\Models\Language;
use Illuminate\Http\Request;

class HomeSectionSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:home section index,admin'])->only('index');
        $this->middleware(['permission:home section update,admin'])->only('update');

    }
    public function index() {
        $languages = Language::where('status' , 1)->get();
        return view('admin.home-section-setting.index' , compact('languages'));
    }

    public function update(Request $request) {
        $request->validate([
            'category_section_one' => 'required|integer',
            'category_section_two' => 'required|integer',
            'category_section_three' => 'required|integer',
            'category_section_four' => 'required|integer',
        ]);

        HomeSectionSetting::updateOrCreate(
            ['language' => $request->language],
            [
                'category_section_one' => $request->category_section_one,
                'category_section_two' => $request->category_section_two,
                'category_section_three' => $request->category_section_three,
                'category_section_four' => $request->category_section_four,
            ]
            );

            toast(__('admin_localize.Updated Successfully') , 'success');
            return redirect()->back();
    }
}
