@extends('frontend.layouts.master')
@section('title' , 'News Page')

@section('content')
<section class="blog_pages">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Breadcrumb -->
                <ul class="breadcrumbs bg-light mb-4">
                    <li class="breadcrumbs__item">
                        <a href="{{url('/')}}" class="breadcrumbs__url">
                            <i class="fa fa-home"></i> {{__('frontend_localize.Home')}}</a>
                    </li>
                    <li class="breadcrumbs__item">
                        <a href="javascript:;" class="breadcrumbs__url">{{__('frontend_localize.News')}}</a>
                    </li>
                    @if (request()->has('search'))
                    <li class="breadcrumbs__item breadcrumbs__item--current">
                        {{request()->search}}
                    </li>
                    @endif
                </ul>
            </div>

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <div class="blog_page_search">
                    <form action="{{route('news')}}" method="GET">
                        <div class="row">
                            <div class="col-lg-5">
                                <input type="text" placeholder="Type here" name="search" value="{{request()->search}}">
                            </div>
                            <div class="col-lg-4">
                                <select name="category">
                                    <option value="">{{__('frontend_localize.All')}}</option>
                                    @foreach ($categories as $category)

                                    <option {{$category->slug === request()->category ? 'selected' : ''}} value="{{$category->slug}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <button type="submit">{{__('frontend_localize.search')}}</button>
                            </div>
                        </div>
                    </form>
                </div>

                <aside class="wrapper__list__article ">
                    @if (request()->has('category') && !empty(request()->category))

                    <h4 class="border_section">{{__('frontend_localize.Category')}} : {{request()->category}}</h4>
                    @elseif(request()->has('tag') && !empty(request()->tag))
                    <h4 class="border_section">{{__('frontend_localize.Tag')}} : {{request()->tag}}</h4>
                    @endif

                    <div class="row">
                        @if (count($news) === 0)
                        <div class="text-center w-100 p-3" style="background-color: #f1f7ff; border-radius: 60px !important;">
                            <h4 style="margin: 0">{{__('frontend_localize.No Results Found')}} :(</h4>
                        </div>

                        @else
                        @foreach ($news as $post)

                        <div class="col-lg-6">
                            <!-- Post Article -->
                            <div class="article__entry">
                                <div class="article__image">
                                    <a href="{{route('news-details' , $post->slug)}}">
                                        <img src="{{asset(env('NEWS_IMAGE_UPLOAD_PATH').$post->image)}}" alt="" class="img-fluid">
                                    </a>
                                </div>
                                <div class="article__content">
                                    <div class="article__category">
                                        {{$post->category->name}}
                                    </div>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <span class="text-primary">
                                                {{__('frontend_localize.by')}} {{$post->author->name}}
                                            </span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span class="text-dark text-capitalize">
                                                {{date('F m, Y' , strtotime($post->created_at))}}
                                            </span>
                                        </li>

                                    </ul>
                                    <h5>
                                        <a href="{{route('news-details' , $post->slug)}}">
                                            {!! limitText($post->title) !!}
                                        </a>
                                    </h5>
                                    <p>
                                        {!!  limitText($post->content , 100) !!}
                                    </p>
                                    <a href="{{route('news-details' , $post->slug)}}" class="btn btn-outline-primary mb-4 text-capitalize"> read more</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>

                </aside>

            </div>
            <div class="col-md-4">
                <div class="sidebar-sticky">
                    <aside class="wrapper__list__article ">
                        <h4 class="border_section">Sidebar</h4>
                        <div class="wrapper__list__article-small">

                            @foreach ($recentNews as $newsPost)
                            @if ($loop->index <= 2)

                            <div class="mb-3">
                                <!-- Post Article -->
                                <div class="card__post card__post-list">
                                    <div class="image-sm">
                                        <a href="{{route('news-details' , $newsPost->slug)}}">
                                            <img src="{{asset(env('NEWS_IMAGE_UPLOAD_PATH').$newsPost->image)}}" class="img-fluid" alt="">
                                        </a>
                                    </div>


                                    <div class="card__post__body ">
                                        <div class="card__post__content">

                                            <div class="card__post__author-info mb-2">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <span class="text-primary">
                                                            {{__('frontend_localize.by')}} {{$newsPost->author->name}}
                                                        </span>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <span class="text-dark text-capitalize">
                                                            {{date('F d, Y' , strtotime($newsPost->created_at))}}
                                                        </span>
                                                    </li>

                                                </ul>
                                            </div>
                                            <div class="card__post__title">
                                                <h6>
                                                    <a href="{{route('news-details' , $newsPost->slug)}}">
                                                        {!! limitText($newsPost->title) !!}
                                                    </a>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($loop->index === 3)

                            <!-- Post Article -->
                            <div class="article__entry">
                                <div class="article__image">
                                    <a href="#">
                                        <img src="{{asset(env('NEWS_IMAGE_UPLOAD_PATH').$newsPost->image)}}" alt="" class="img-fluid">
                                    </a>
                                </div>
                                <div class="article__content">
                                    <div class="article__category">
                                        {{$newsPost->category->name}}
                                    </div>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <span class="text-primary">
                                                {{__('frontend_localize.by')}} {{$newsPost->author->name}}
                                            </span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span class="text-dark text-capitalize">
                                                {{date('F d, Y' , strtotime($newsPost->created_at))}}
                                            </span>
                                        </li>

                                    </ul>
                                    <h5>
                                        <a href="{{route('news-details' , $newsPost->slug)}}">
                                            {!! limitText($newsPost->title) !!}
                                        </a>
                                    </h5>
                                    <p>
                                       {!! limitText($newsPost->content , 200) !!}
                                    </p>
                                    <a href="{{route('news-details' , $newsPost->slug)}}" class="btn btn-outline-primary mb-4 text-capitalize"> {{__('frontend_localize.read more')}}</a>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </aside>

                    <aside class="wrapper__list__article">
                        <h4 class="border_section">{{__('frontend_localize.tags')}}</h4>
                        <div class="blog-tags p-0">
                            <ul class="list-inline">
                                @foreach ($mostPopularTag as $tag)

                                <li class="list-inline-item">
                                    <a href="{{route('news' , ['tag' => $tag->name])}}">
                                        #{{$tag->name}} ({{$tag->count}})
                                    </a>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </aside>

                    <aside class="wrapper__list__article">
                        <h4 class="border_section">{{__('frontend_localize.newsletter')}}</h4>
                        <!-- Form Subscribe -->
                        <div class="widget__form-subscribe bg__card-shadow">
                            <h6>
                                {{__('frontend_localize.The most important world news and events of the day')}}.
                            </h6>
                            <p><small>{{__('frontend_localize.Get magazine daily newsletter on your inbox')}}.</small></p>
                            <form class="newsletter-form">

                                <div class="input-group ">
                                    <input type="text" class="form-control" name="email" placeholder="{{__('frontend_localize.Your email address')}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary newsletter-btn" type="submit">{{__('frontend_localize.sign up')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </aside>

                    @if ($ad->sidebar_ad_status == 1)

                    <aside class="wrapper__list__article">
                        <h4 class="border_section">{{__('frontend_localize.Advertise')}}</h4>
                        <a href="{{$ad->sidebar_ad_url}}">
                            <figure>
                                <img src="{{asset(env('AD_IMAGE_UPLOAD_PATH').$ad->sidebar_ad)}}" alt="" class="img-fluid">
                            </figure>
                        </a>
                    </aside>
                    @endif
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
        <!-- Pagination -->
        {{$news->withQueryString()->links()}}


    </div>
    @if ($ad->news_page_ad_status == 1)

    <div class="large_add_banner mb-4 mt-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="large_add_banner_img">
                        <a href="{{$ad->news_page_ad_url}}"></a>
                        <img src="{{asset(env('AD_IMAGE_UPLOAD_PATH').$ad->news_page_ad)}}" alt="adds">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
@endsection
