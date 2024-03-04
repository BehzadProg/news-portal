<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\SocialCount;
use Illuminate\Http\Request;

class SocialCountController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:social count index,admin'])->only('index');
        $this->middleware(['permission:social count create,admin'])->only(['create' , 'store']);
        $this->middleware(['permission:social count update,admin'])->only(['edit' , 'update']);
        $this->middleware(['permission:social count delete,admin'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::where('status' , 1)->get();
        return view('admin.social-count.index' , compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::where('status' , 1)->get();
        return view('admin.social-count.create' , compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|not_in:empty',
            'url' => 'required|url',
            'fan_count' => 'required|max:255',
            'fan_type' => 'required|max:255',
            'button_text' => 'required|max:255',
            'color' => 'required|max:255',
        ]);

        $socialCount = new SocialCount();
        $socialCount->language = $request->language;
        $socialCount->icon = $request->icon;
        $socialCount->url = $request->url;
        $socialCount->fan_count = $request->fan_count;
        $socialCount->fan_type = $request->fan_type;
        $socialCount->button_text = $request->button_text;
        $socialCount->color = $request->color;
        $socialCount->status = $request->status;
        $socialCount->save();

        toast()->success(__('admin_localize.Created Successfully'));
        return redirect()->route('admin.social-count.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $socialCount = SocialCount::findOrFail($id);
        $languages = Language::where('status' , 1)->get();
        return view('admin.social-count.edit' , compact('socialCount' , 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' => 'required|not_in:empty',
            'url' => 'required|url',
            'fan_count' => 'required|max:255',
            'fan_type' => 'required|max:255',
            'button_text' => 'required|max:255',
            'color' => 'required|max:255',
        ]);

        $socialCount = SocialCount::findOrFail($id);
        $socialCount->language = $request->language;
        $socialCount->icon = $request->icon;
        $socialCount->url = $request->url;
        $socialCount->fan_count = $request->fan_count;
        $socialCount->fan_type = $request->fan_type;
        $socialCount->button_text = $request->button_text;
        $socialCount->color = $request->color;
        $socialCount->status = $request->status;
        $socialCount->save();

        toast()->success(__('admin_localize.Updated Successfully'));
        return redirect()->route('admin.social-count.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $socialCount = SocialCount::findOrFail($id);
        $socialCount->delete();

        return response(['status' => 'success' , 'message' => __('admin_localize.Deleted Successfully')]);
    }
}
