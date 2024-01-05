<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::where(['is_breaking_news' => 1])
        ->activeEntries()->withLocalize()->orderByDesc('id')->take(10)->get();
        return view('frontend.home' , compact('news'));
    }

    public function showNews(string $slug) {
        $newsDetail = News::with(['author' , 'category'])->where('slug' , $slug)
        ->activeEntries()->withLocalize()->first();
        // counting view posts
        $this->countViews($newsDetail);
        return view('frontend.news-details' , compact('newsDetail'));
    }

    public function countViews($news)
    {
        if(session()->has('viewed_posts')){
            $postsIds = session()->get('viewed_posts');
            if(!in_array($news->id , $postsIds)){

                $postsIds[] = $news->id;
                $news->increment('views');
            }
            session()->put(['viewed_posts' => $postsIds]);
        }else{
            session()->put(['viewed_posts' => [$news->id]]);
            $news->increment('views');
        }
    }
}
