<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::latest()->get();
        return view('admin.language.index' , compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.language.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lang' => 'required|max:255|unique:languages,lang',
            'name' => 'required|max:255',
            'slug' => 'required|max:255|unique:languages,slug',
            'default' => 'required|boolean',
            'status' => 'required|boolean',
        ]);


        $lang =  new Language();
        $lang->name = $request->name;
        $lang->lang = $request->lang;
        $lang->slug = $request->slug;
        $lang->default = $request->default;
        $lang->status = $request->status;
        $lang->save();

        toast(__('Created Successfully') , 'success')->width('400');
        return redirect()->route('admin.language.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $languages = Language::findOrFail($id);
        return view('admin.language.edit' , compact('languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'lang' => 'required|max:255|unique:languages,lang,'.$id,
            'name' => 'required|max:255',
            'slug' => 'required|max:255|unique:languages,slug,'.$id,
            'default' => 'required|boolean',
            'status' => 'required|boolean',
        ]);


        $lang = Language::findOrFail($id);
        $lang->name = $request->name;
        $lang->lang = $request->lang;
        $lang->slug = $request->slug;
        $lang->default = $request->default;
        $lang->status = $request->status;
        $lang->save();

        toast(__('Updated Successfully') , 'success')->width('400');
        return redirect()->route('admin.language.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $lang = Language::findOrFail($id);
            $lang->delete();
            return response(['status' => 'success' , 'message' => __('Deleted Successfully')]);
        } catch (\Throwable $th) {
            return response(['status' => 'error' , 'message' => __('Somthing went wrong!')]);
        }
    }
}
