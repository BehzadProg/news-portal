<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function adminIndex() : View
    {
        $languages = Language::where('status' , 1)->get();
        return view('admin.localization.admin-index' , compact('languages'));
    }

    public function frontendIndex() : View
    {
        $languages = Language::where('status' , 1)->get();
        return view('admin.localization.frontend-index' , compact('languages'));
    }
}
