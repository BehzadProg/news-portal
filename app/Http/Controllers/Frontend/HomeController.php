<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Tag;
use App\Models\News;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::where(['is_breaking_news' => 1])
        ->activeEntries()->withLocalize()->orderByDesc('id')->take(10)->get();
        return view('frontend.home' , compact('news'));
    }

    public function showNews(string $slug)
    {

        $newsDetail = News::with(['author' , 'category' , 'tags' , 'comments'])->where('slug' , $slug)
        ->activeEntries()->withLocalize()->first();
        // counting view posts
        $this->countViews($newsDetail);

        //get recent news post for sidebar
        $recentNews = News::with(['author' , 'category'])->where('slug' , '!=' , $newsDetail->slug)
        ->activeEntries()->withLocalize()->orderByDesc('id')->take(4)->get();

        $mostPopularTag = $this->mostPopularTags();

        $nextPost = News::where('id','>', $newsDetail->id)
        ->activeEntries()
        ->withLocalize()
        ->orderBy('id' , 'asc')->first();

        $previousPost = News::where('id','<', $newsDetail->id)
        ->activeEntries()
        ->withLocalize()
        ->orderBy('id' , 'desc')->first();

        $relatedPosts = News::where('slug' , '!=' , $newsDetail->slug)
        ->where('category_id' , $newsDetail->category_id)
        ->activeEntries()
        ->withLocalize()
        ->take(5)->get();

        return view('frontend.news-details' , compact(
            'newsDetail',
             'recentNews' ,
              'mostPopularTag',
              'nextPost',
              'previousPost',
              'relatedPosts'
            ));
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

    public function mostPopularTags(){
        return Tag::select('name' , \DB::raw('COUNT(*) as count'))
        ->where('language' , getLanguage())
        ->groupBy('name')
        ->orderByDesc('count')
        ->take(15)->get();
    }

    public function handleComment(Request $request) {
        $request->validate([
            'comment' => 'required|max:1000|string'
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->news_id = $request->news_id;
        $comment->parent_id = $request->parent_id;
        $comment->comment = $request->comment;
        $comment->save();

        alert()->success(__('Thank you'), __('By leaving your opinion in the comment section!'));
        return redirect()->back();
    }

    public function handleReply(Request $request) {
        $request->validate([
            'reply' => 'required|max:1000|string'
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->news_id = $request->news_id;
        $comment->parent_id = $request->parent_id;
        $comment->comment = $request->reply;
        $comment->save();

        alert()->success(__('Thank you'), __('Your replay submitted successfully'));
        return redirect()->back();
    }

    public function commentDestroy(Request $request)
    {
        $comment = Comment::findOrFail($request->id);
        if(Auth::user()->id === $comment->user_id){
            $comment->delete();
            return response(['status' => 'success' , 'message' => __('Deleted successfully')]);
        }
        return response(['status' => 'error' , 'message' => __('something went wrong')]);
    }
}
