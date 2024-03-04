<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Models\FooterTitle;
use Illuminate\Http\Request;
use App\Models\FooterGridThree;
use App\Http\Controllers\Controller;

class FooterGridThreeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:footer index,admin'])->only(['index' ,'handleTitle']);
        $this->middleware(['permission:footer create,admin'])->only(['create' , 'store']);
        $this->middleware(['permission:footer update,admin'])->only(['edit' , 'update']);
        $this->middleware(['permission:footer delete,admin'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::where('status' , 1)->get();
        return view('admin.footer-grid-three.index' , compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::where('status' , 1)->get();
        return view('admin.footer-grid-three.create' , compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'url' => 'required|max:255',
            'language' => 'required',
            'status' => 'required',
        ]);

        $footer = new FooterGridThree();
        $footer->language = $request->language;
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();

        toast(__('admin_localize.Created Successfully') , 'success');
        return redirect()->route('admin.footer-grid-three.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $languages = Language::where('status' , 1)->get();
        $footer = FooterGridThree::findOrFail($id);
        return view('admin.footer-grid-three.edit' , compact('languages' , 'footer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'url' => 'required|max:255',
            'language' => 'required',
            'status' => 'required',
        ]);

        $footer = FooterGridThree::findOrFail($id);
        $footer->language = $request->language;
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();

        toast(__('admin_localize.Updated Successfully') , 'success');
        return redirect()->route('admin.footer-grid-three.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footer = FooterGridThree::findOrFail($id);
        $footer->delete();
        return response(['status' => 'success' , 'message' => __('admin_localize.Deleted Successfully')]);
    }

    public function handleTitle(Request $request) {
        $request->validate([
            'title' => 'required|max:255'
        ]);

        FooterTitle::updateOrCreate(
            [
                'key' => 'grid_three_title',
                'language' => $request->language
            ],
            [
                'value' => $request->title
            ]
        );

        toast(__('admin_localize.Updated Successfully') , 'success');
        return redirect()->back();
    }
}
