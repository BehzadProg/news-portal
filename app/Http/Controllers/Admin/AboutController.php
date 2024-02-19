<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index()
    {
        $languages = Language::where('status' , 1)->get();
        return view('admin.about.index' , compact('languages'));
    }

    public function update(Request $request)
    {

        $request->validate(['content' => 'required']);

        About::updateOrCreate(
            ['language' => $request->language],
            ['content' => $request->content]
        );

        toast(__('Updated Successfully') , 'success');
        return redirect()->back();
    }
}
