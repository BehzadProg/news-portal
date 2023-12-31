<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\News;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::where('status' , 1)->get();
        return view('admin.news.index' , compact('languages'));
    }
     /**
     * Fetch Category Base On Language.
     */
    public function fetchNewsCategory(Request $request)
    {
        $category = Category::where(['status' => 1 , 'language' => $request->lang])->get();
        return $category;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::where('status' , 1)->get();
        return view('admin.news.create' , compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'language' => 'required',
            'category' => 'required',
            'image' => 'required|max:3000|image',
            'title' => 'required|max:255|unique:news,title',
            'content' => 'required',
            'tags' => 'required',
            'meta_title' => 'max:255',
            'meta_description' => 'max:255',
            'is_breaking_news' => 'boolean',
            'show_at_slider' => 'boolean',
            'show_at_popular' => 'boolean',
            'status' => 'boolean',
        ]);

        $imagePath = $this->handleUpload('image' , null , env('NEWS_IMAGE_UPLOAD_PATH') , 'news_image');
        $news = new News();
        $news->language = $request->language;
        $news->category_id = $request->category;
        $news->author_id = Auth::guard('admin')->user()->id;
        $news->image = $imagePath;
        $news->title = $request->title;
        $news->content = $request->content;
        $news->meta_title = $request->meta_title;
        $news->meta_description = $request->meta_description;
        $news->is_breaking_news = $request->is_breaking_news == 1 ? 1 : 0;
        $news->show_at_slider = $request->show_at_slider == 1 ? 1 : 0;
        $news->show_at_popular = $request->show_at_popular == 1 ? 1 : 0;
        $news->status = $request->status == 1 ? 1 : 0;
        $news->save();

        $tags = explode(',' , $request->tags);
        $tagIds = [];
        foreach($tags as $tag){
            $item = new Tag();
            $item->name = $tag;
            $item->save();

            $tagIds[] = $item->id;

        }

        $news->tags()->attach($tagIds);

        toast(__('Created Successfully') , 'success')->width('400');
        return redirect()->route('admin.news.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
