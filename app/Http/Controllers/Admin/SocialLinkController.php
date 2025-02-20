<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:footer index,admin'])->only('index');
        $this->middleware(['permission:footer create,admin'])->only(['create' , 'store']);
        $this->middleware(['permission:footer update,admin'])->only(['edit' , 'update']);
        $this->middleware(['permission:footer delete,admin'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socialLinks = SocialLink::all();
        return view('admin.social-link.index' , compact('socialLinks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.social-link.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|not_in:empty',
            'url' => 'required|url',
            'status' => 'required',
        ]);

        $social = new SocialLink();
        $social->icon = $request->icon;
        $social->url = $request->url;
        $social->status = $request->status;
        $social->save();

        toast()->success(__('admin_localize.Created Successfully'));
        return redirect()->route('admin.social-link.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $socialLink = SocialLink::findOrFail($id);
        return view('admin.social-link.edit' , compact('socialLink'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' => 'required|not_in:empty',
            'url' => 'required|url',
            'status' => 'required',
        ]);

        $social = SocialLink::findOrFail($id);
        $social->icon = $request->icon;
        $social->url = $request->url;
        $social->status = $request->status;
        $social->save();

        toast()->success(__('admin_localize.Updated Successfully'));
        return redirect()->route('admin.social-link.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $social = SocialLink::findOrFail($id);
        $social->delete();

        return response(['status' => 'success' , 'message' => __('admin_localize.Deleted Successfully')]);
    }
}
