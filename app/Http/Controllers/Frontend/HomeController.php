<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Tag;
use App\Models\News;
use App\Models\About;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Category;
use App\Mail\ContactMail;
use App\Models\SocialLink;
use App\Models\SocialCount;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\HomeSectionSetting;
use App\Http\Controllers\Controller;
use App\Models\ReceivedMail;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $breakingNews = News::where('is_breaking_news', 1)
            ->activeEntries()->withLocalize()->orderByDesc('id')->take(10)->get();

        $heroSlider = News::with(['category', 'author'])->where('show_at_slider', 1)
            ->activeEntries()->withLocalize()->orderByDesc('id')->take(8)->get();

        $recentPosts = News::with(['category', 'author'])
            ->activeEntries()->withLocalize()->orderByDesc('id')->take(6)->get();

        $popularPosts = News::with('category')->where('show_at_popular', 1)
            ->activeEntries()->withLocalize()->orderByDesc('updated_at')->take(4)->get();

        $homeSectionSetting = HomeSectionSetting::where('language', getLanguage())->first();
        $sectionOneNews = News::where('category_id', @$homeSectionSetting->category_section_one)
            ->activeEntries()->withLocalize()->orderByDesc('id')->take(8)->get();
        $sectionTwoNews = News::where('category_id', @$homeSectionSetting->category_section_two)
            ->activeEntries()->withLocalize()->orderByDesc('id')->take(8)->get();
        $sectionThreeNews = News::where('category_id', @$homeSectionSetting->category_section_three)
            ->activeEntries()->withLocalize()->orderByDesc('id')->take(6)->get();
        $sectionFourNews = News::where('category_id', @$homeSectionSetting->category_section_four)
            ->activeEntries()->withLocalize()->orderByDesc('id')->take(4)->get();

        //get recent news post for sidebar
        $mostViewedNews = News::with(['author', 'category'])
            ->activeEntries()->withLocalize()->orderByDesc('views')->take(3)->get();

        $socialCounts = SocialCount::where(['status' => 1, 'language' => getLanguage()])->get();

        $mostPopularTag = $this->mostPopularTags();

        $ad = Advertisement::first();

        return view('frontend.home', compact(
            'breakingNews',
            'heroSlider',
            'recentPosts',
            'popularPosts',
            'sectionOneNews',
            'sectionTwoNews',
            'sectionThreeNews',
            'sectionFourNews',
            'mostViewedNews',
            'socialCounts',
            'mostPopularTag',
            'ad'
        ));
    }

    public function news(Request $request)
    {

        $news = News::query();

        $news->when($request->has('tag') && !empty($request->tag), function ($query) use ($request) {
            $query->whereHas('tags', function ($query) use ($request) {
                $query->where('name', $request->tag);
            });
        });

        $news->when($request->has('category') && !empty($request->category), function ($query) use ($request) {
            $query->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            });
        });

        $news->when($request->has('search'), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%');
            })
                ->orWhereHas('category', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                });
        });

        $news = $news->orderByDesc('id')->activeEntries()->withLocalize()->paginate(8);

        //get recent news post for sidebar
        $recentNews = News::with(['author', 'category'])
            ->activeEntries()->withLocalize()->orderByDesc('id')->take(4)->get();

        $mostPopularTag = $this->mostPopularTags();

        $categories = Category::where(['status' => 1, 'language' => getLanguage()])->get();

        $ad = Advertisement::first();

        return view('frontend.news', compact('news', 'recentNews', 'mostPopularTag', 'categories', 'ad'));
    }

    public function showNews(string $slug)
    {

        $newsDetail = News::with(['author', 'category', 'tags', 'comments'])->where('slug', $slug)
            ->activeEntries()->withLocalize()->first();
        // counting view posts
        $this->countViews($newsDetail);

        //get recent news post for sidebar
        $recentNews = News::with(['author', 'category'])->where('slug', '!=', $newsDetail->slug)
            ->activeEntries()->withLocalize()->orderByDesc('id')->take(4)->get();

        $mostPopularTag = $this->mostPopularTags();

        $nextPost = News::where('id', '>', $newsDetail->id)
            ->activeEntries()
            ->withLocalize()
            ->orderBy('id', 'asc')->first();

        $previousPost = News::where('id', '<', $newsDetail->id)
            ->activeEntries()
            ->withLocalize()
            ->orderBy('id', 'desc')->first();

        $relatedPosts = News::where('slug', '!=', $newsDetail->slug)
            ->where('category_id', $newsDetail->category_id)
            ->activeEntries()
            ->withLocalize()
            ->take(5)->get();

        $socialCounts = SocialCount::where(['status' => 1, 'language' => getLanguage()])->get();

        $ad = Advertisement::first();

        return view('frontend.news-details', compact(
            'newsDetail',
            'recentNews',
            'mostPopularTag',
            'nextPost',
            'previousPost',
            'relatedPosts',
            'socialCounts',
            'ad'
        ));
    }

    public function countViews($news)
    {
        if (session()->has('viewed_posts')) {
            $postsIds = session()->get('viewed_posts');
            if (!in_array($news->id, $postsIds)) {

                $postsIds[] = $news->id;
                $news->increment('views');
            }
            session()->put(['viewed_posts' => $postsIds]);
        } else {
            session()->put(['viewed_posts' => [$news->id]]);
            $news->increment('views');
        }
    }

    public function mostPopularTags()
    {
        return Tag::select('name', \DB::raw('COUNT(*) as count'))
            ->where('language', getLanguage())
            ->groupBy('name')
            ->orderByDesc('count')
            ->take(15)->get();
    }

    public function handleComment(Request $request)
    {
        $request->validate([
            'comment' => 'required|max:1000|string'
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->news_id = $request->news_id;
        $comment->parent_id = $request->parent_id;
        $comment->comment = $request->comment;
        $comment->save();

        alert()->success(__('frontend_localize.Thank you'), __('frontend_localize.By leaving your opinion in the comment section!'));
        return redirect()->back();
    }

    public function handleReply(Request $request)
    {
        $request->validate([
            'reply' => 'required|max:1000|string'
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->news_id = $request->news_id;
        $comment->parent_id = $request->parent_id;
        $comment->comment = $request->reply;
        $comment->save();

        alert()->success(__('frontend_localize.Thank you'), __('frontend_localize.Your replay submitted successfully'));
        return redirect()->back();
    }

    public function commentDestroy(Request $request)
    {
        $comment = Comment::findOrFail($request->id);
        if (Auth::user()->id === $comment->user_id) {
            $comment->delete();
            return response(['status' => 'success', 'message' => __('frontend_localize.Deleted successfully')]);
        }
        return response(['status' => 'error', 'message' => __('frontend_localize.something went wrong')]);
    }

    public function about()
    {
        $about = About::where('language', getLanguage())->first();
        return view('frontend.about', compact('about'));
    }

    public function contact()
    {
        $contact = Contact::where('language', getLanguage())->first();
        $socialLinks = SocialLink::where('status', 1)->get();
        return view('frontend.contact', compact('contact', 'socialLinks'));
    }

    public function contactHandleForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'subject' => 'required|max:255',
            'message' => 'required|max:500',
        ]);

        try {
            //send mail
            $toMail = Contact::where('language', 'en')->first();

            Mail::to($toMail->email)->send(new ContactMail($request->email, $request->subject, $request->message));

            //store into database
            $mail = new ReceivedMail();
            $mail->email = $request->email;
            $mail->subject = $request->subject;
            $mail->message = $request->message;
            $mail->save();

            toast(__('frontend_localize.Your message sent Successfully'), 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            toast(__($e->getMessage()), 'error');
            return redirect()->back();
        }
    }

    public function subNewsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:100|unique:subscribers,email',
        ],
        [
            'email.unique' => __('frontend_localize.Email is already subscribed')
        ]);

        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->save();

        return response(['status' => 'success' , 'message' => __('frontend_localize.Subscribed Successfully')]);
    }
}
