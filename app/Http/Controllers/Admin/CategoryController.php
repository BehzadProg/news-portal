<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use App\Models\News;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:category index,admin'])->only('index');
        $this->middleware(['permission:category create,admin'])->only(['create' , 'store']);
        $this->middleware(['permission:category update,admin'])->only(['edit' , 'update']);
        $this->middleware(['permission:category delete,admin'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::where('status' , 1)->get();
        $categories = Category::latest()->get();
        return view('admin.category.index' , compact('languages' , 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::where('status' , 1)->get();
        return view('admin.category.create' , compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'language' => 'required',
            'name' => 'required|max:255|unique:categories,name',
            'show_at_nav' => 'required|boolean',
            'status' => 'required|boolean',
        ]);

        $category = new Category();
        $category->language = $request->language;
        $category->name = $request->name;
        $category->slug = \Str::slug($request->name);
        $category->show_at_nav = $request->show_at_nav;
        $category->status = $request->status;
        $category->save();

        toast(__('admin_localize.Created Successfully') , 'success')->width('400');
        return redirect()->route('admin.category.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $languages = Language::where('status' , 1)->get();
        $category = Category::findOrFail($id);
        return view('admin.category.edit' , compact('languages','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'language' => 'required',
            'name' => 'required|max:255|unique:categories,name,'.$id,
            'show_at_nav' => 'required|boolean',
            'status' => 'required|boolean',
        ]);

        $category = Category::findOrFail($id);
        $category->language = $request->language;
        $category->name = $request->name;
        $category->show_at_nav = $request->show_at_nav;
        $category->status = $request->status;
        $category->save();

        toast(__('admin_localize.Updated Successfully') , 'success')->width('400');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $news = News::where('category_id' , $category->id)->get();
        foreach ($news as $item) {
            $item->tags()->delete();
        }
        $category->delete();
        return response(['status' => 'success' , 'message' => __('admin_localize.Deleted Successfully')]);
    }
}
