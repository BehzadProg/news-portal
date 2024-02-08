<section class="pt-0 mt-5">
    <div class="popular__section-news">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="wrapper__list__article">
                        <h4 class="border_section">{{__('recent post')}}</h4>
                    </div>
                    <div class="row">
                        @foreach ($recentPosts as $post)
                        @if ($loop->index <= 1)

                        <div class="col-sm-12 col-md-6 mb-4">
                            <!-- Post Article -->
                            <div class="card__post ">
                                <div class="card__post__body card__post__transition">
                                    <a href="{{route('news-details' , $post->slug)}}">
                                        <img src="{{asset(env('NEWS_IMAGE_UPLOAD_PATH').$post->image)}}" class="img-fluid" alt="">
                                    </a>
                                    <div class="card__post__content bg__post-cover">
                                        <div class="card__post__category">
                                            {{$post->category->name}}
                                        </div>
                                        <div class="card__post__title">
                                            <h5>
                                                <a href="{{route('news-details' , $post->slug)}}">
                                                    {!! limitText($post->title) !!}
                                                </a>
                                            </h5>
                                        </div>
                                        <div class="card__post__author-info">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="javascript:;">
                                                        {{__('by')}} {{$post->author->name}}
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <span>
                                                        {{date('F d, Y' , strtotime($post->created_at))}}
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endif
                        @endforeach

                    </div>
                    <div class="row ">
                        <div class="col-sm-12 col-md-6">
                            <div class="wrapp__list__article-responsive">
                                @foreach ($recentPosts as $post)
                                @if ($loop->index > 1 && $loop->index <= 3)
                                <div class="mb-3">
                                    <!-- Post Article -->
                                    <div class="card__post card__post-list">
                                        <div class="image-sm">
                                            <a href="{{route('news-details' , $post->slug)}}">
                                                <img src="{{asset(env('NEWS_IMAGE_UPLOAD_PATH').$post->image)}}" class="img-fluid" alt="">
                                            </a>
                                        </div>


                                        <div class="card__post__body ">
                                            <div class="card__post__content">

                                                <div class="card__post__author-info mb-2">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span class="text-primary">
                                                                {{__('by')}} {{$post->author->name}}
                                                            </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span class="text-dark text-capitalize">
                                                                {{date('F d, Y' , strtotime($post->created_at))}}
                                                            </span>
                                                        </li>

                                                    </ul>
                                                </div>
                                                <div class="card__post__title">
                                                    <h6>
                                                        <a href="{{route('news-details' , $post->slug)}}">
                                                            {!! limitText($post->title) !!}
                                                        </a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 ">
                            <div class="wrapp__list__article-responsive">
                                @foreach ($recentPosts as $post)
                                @if ($loop->index > 3 && $loop->index <= 5)
                                <div class="mb-3">
                                    <!-- Post Article -->
                                    <div class="card__post card__post-list">
                                        <div class="image-sm">
                                            <a href="{{route('news-details' , $post->slug)}}" target="_blank">
                                                <img src="{{asset(env('NEWS_IMAGE_UPLOAD_PATH').$post->image)}}" class="img-fluid" alt="">
                                            </a>
                                        </div>


                                        <div class="card__post__body ">
                                            <div class="card__post__content">

                                                <div class="card__post__author-info mb-2">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span class="text-primary">
                                                                {{__('by')}} {{$post->author->name}}
                                                            </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span class="text-dark text-capitalize">
                                                                {{date('F d, Y' , strtotime($post->created_at))}}
                                                            </span>
                                                        </li>

                                                    </ul>
                                                </div>
                                                <div class="card__post__title">
                                                    <h6>
                                                        <a href="{{route('news-details' , $post->slug)}}" target="_blank">
                                                            {!! limitText($post->title) !!}
                                                        </a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 col-lg-4">
                    <aside class="wrapper__list__article">
                        <h4 class="border_section">{{__('popular post')}}</h4>
                        <div class="wrapper__list-number">

                            <!-- List Article -->
                            @foreach ($popularPosts as $post)

                            <div class="card__post__list">
                                <div class="list-number">
                                    <span>
                                        {{ ++ $loop->index}}
                                    </span>
                                </div>
                                <a href="{{route('news' , ['category' => $post->category->slug])}}" class="category">
                                    {{$post->category->name}}
                                </a>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <h5>
                                            <a href="{{route('news-details' , $post->slug)}}" target="_blank">
                                                {!! limitText($post->title , 80) !!}
                                            </a>
                                        </h5>
                                    </li>
                                </ul>
                            </div>
                            @endforeach
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>

    <!-- Post news carousel -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <aside class="wrapper__list__article">
                    <h4 class="border_section">{{@$sectionOneNews->first()->category->name}}</h4>
                </aside>
            </div>

            <div class="col-md-12">

                <div class="article__entry-carousel">
                    @foreach ($sectionOneNews as $categoryOneNews)

                    <div class="item">
                        <!-- Post Article -->
                        <div class="article__entry">
                            <div class="article__image">
                                <a href="{{route('news-details' , $categoryOneNews->slug)}}">
                                    <img src="{{asset(env('NEWS_IMAGE_UPLOAD_PATH').$categoryOneNews->image)}}" alt="" class="img-fluid">
                                </a>
                            </div>
                            <div class="article__content">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <span class="text-primary">
                                            {{__('by')}} {{$categoryOneNews->author->name}}
                                        </span>
                                    </li>
                                    <li class="list-inline-item">
                                        <span>
                                            {{date('F d, Y' , strtotime($categoryOneNews->created_at))}}
                                        </span>
                                    </li>

                                </ul>
                                <h5>
                                    <a href="{{route('news-details' , $categoryOneNews->slug)}}">
                                        {{limitText($categoryOneNews->title , 35)}}
                                    </a>
                                </h5>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- End Popular news category -->
    <!-- Post news carousel -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <aside class="wrapper__list__article">
                    <h4 class="border_section">{{@$sectionTwoNews->first()->category->name}}</h4>
                </aside>
            </div>
            <div class="col-md-12">

                <div class="article__entry-carousel">
                    @foreach ($sectionTwoNews as $categoryTwoNews)

                    <div class="item">
                        <!-- Post Article -->
                        <div class="article__entry">
                            <div class="article__image">
                                <a href="{{route('news-details' , $categoryTwoNews->slug)}}">
                                    <img src="{{asset(env('NEWS_IMAGE_UPLOAD_PATH').$categoryTwoNews->image)}}" alt="" class="img-fluid">
                                </a>
                            </div>
                            <div class="article__content">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <span class="text-primary">
                                            {{__('by')}} {{$categoryTwoNews->author->name}}
                                        </span>
                                    </li>
                                    <li class="list-inline-item">
                                        <span>
                                            {{date('F d, Y' , strtotime($categoryTwoNews->created_at))}}
                                        </span>
                                    </li>

                                </ul>
                                <h5>
                                    <a href="{{route('news-details' , $categoryTwoNews->slug)}}">
                                        {{limitText($categoryTwoNews->title , 35)}}
                                    </a>
                                </h5>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- End Popular news category -->


    <!-- Popular news category -->
    <div class="mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <aside class="wrapper__list__article mb-0">
                        <h4 class="border_section">{{@$sectionThreeNews->first()->category->name}}</h4>
                        <div class="row">
                            <div class="col-md-6">
                                @foreach ($sectionThreeNews as $categoryThreeNews)
                                @if ($loop->index <= 2)

                                <div class="mb-4">
                                    <!-- Post Article -->
                                    <div class="article__entry">
                                        <div class="article__image">
                                            <a href="{{route('news-details' , $categoryThreeNews->slug)}}">
                                                <img src="{{asset(env('NEWS_IMAGE_UPLOAD_PATH').$categoryThreeNews->image)}}" alt="" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="article__content">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <span class="text-primary">
                                                        {{__('by')}} {{$categoryThreeNews->author->name}}
                                                    </span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <span>
                                                        {{date('F d, Y' , strtotime($categoryThreeNews->created_at))}}
                                                    </span>
                                                </li>

                                            </ul>
                                            <h5>
                                                <a href="{{route('news-details' , $categoryThreeNews->slug)}}">
                                                    {{limitText($categoryThreeNews->title)}}
                                                </a>
                                            </h5>

                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach

                            </div>
                            <div class="col-md-6">
                                @foreach ($sectionThreeNews as $categoryThreeNews)
                                @if ($loop->index > 2 && $loop->index <= 5)

                                <div class="mb-4">
                                    <!-- Post Article -->
                                    <div class="article__entry">
                                        <div class="article__image">
                                            <a href="{{route('news-details' , $categoryThreeNews->slug)}}">
                                                <img src="{{asset(env('NEWS_IMAGE_UPLOAD_PATH').$categoryThreeNews->image)}}" alt="" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="article__content">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <span class="text-primary">
                                                        {{__('by')}} {{$categoryThreeNews->author->name}}
                                                    </span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <span>
                                                        {{date('F d, Y' , strtotime($categoryThreeNews->created_at))}}
                                                    </span>
                                                </li>

                                            </ul>
                                            <h5>
                                                <a href="{{route('news-details' , $categoryThreeNews->slug)}}">
                                                    {{limitText($categoryThreeNews->title)}}
                                                </a>
                                            </h5>

                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </aside>

                    <div class="small_add_banner">
                        <div class="small_add_banner_img">
                            <img src="{{asset('frontend/assets/images/placeholder_large.jpg')}}" alt="adds">
                        </div>
                    </div>

                    <aside class="wrapper__list__article mt-5">
                        <h4 class="border_section">{{@$sectionFourNews->first()->category->name}}</h4>

                        <div class="wrapp__list__article-responsive">
                            <!-- Post Article List -->
                            @foreach ($sectionFourNews as $categoryFourNews)

                            <div class="card__post card__post-list card__post__transition mt-30">
                                <div class="row ">
                                    <div class="col-md-5">
                                        <div class="card__post__transition">
                                            <a href="{{route('news-details' , $categoryFourNews->slug)}}">
                                                <img src="{{asset(env('NEWS_IMAGE_UPLOAD_PATH').$categoryFourNews->image)}}" class="img-fluid w-100" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-7 my-auto pl-0">
                                        <div class="card__post__body ">
                                            <div class="card__post__content  ">
                                                <div class="card__post__category ">
                                                    {{$categoryFourNews->category->name}}
                                                </div>
                                                <div class="card__post__author-info mb-2">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span class="text-primary">
                                                                {{__('by')}} {{$categoryFourNews->author->name}}
                                                            </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span class="text-dark text-capitalize">
                                                                {{date('F d, Y' , strtotime($categoryFourNews->created_at))}}
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="card__post__title">
                                                    <h5>
                                                        <a href="{{route('news-details' , $categoryFourNews->slug)}}">
                                                            {!!limitText($categoryFourNews->title)!!}
                                                        </a>
                                                    </h5>
                                                    <p class="d-none d-lg-block d-xl-block mb-0">
                                                        {!! limitText($categoryFourNews->content , 100) !!}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endforeach

                        </div>
                    </aside>
                </div>

                <div class="col-md-4">
                    <div class="sticky-top">
                        <aside class="wrapper__list__article">
                            <h4 class="border_section">
                                {{__('Most Viewed')}}</h4>
                            <div class="wrapper__list__article-small">

                                <!-- Post Article -->
                                @foreach ($mostViewedNews as $mostViewed)
                                @if ($loop->index === 0)

                                <div class="article__entry">
                                    <div class="article__image">
                                        <a href="{{route('news-details' , $mostViewed->slug)}}">
                                            <img src="{{asset(env('NEWS_IMAGE_UPLOAD_PATH').$mostViewed->image)}}" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="article__content">
                                        <div class="article__category">
                                            {{$mostViewed->category->name}}
                                        </div>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <span class="text-primary">
                                                    {{__('by')}} {{$mostViewed->author->name}}
                                                </span>
                                            </li>
                                            <li class="list-inline-item">
                                                <span class="text-dark text-capitalize">
                                                    {{date('F d, Y' , strtotime($mostViewed->created_at))}}
                                                </span>
                                            </li>

                                        </ul>
                                        <h5>
                                            <a href="{{route('news-details' , $mostViewed->slug)}}">
                                                {!!limitText($mostViewed->title)!!}
                                            </a>
                                        </h5>
                                        <p>
                                            {!! limitText($mostViewed->content , 120) !!}
                                        </p>
                                        <a href="{{route('news-details' , $mostViewed->slug)}}" class="btn btn-outline-primary mb-4 text-capitalize"> {{__('read more')}}</a>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                @foreach ($mostViewedNews as $mostViewed)
                                @if ($loop->index > 0)
                                <div class="mb-3">
                                    <!-- Post Article -->
                                    <div class="card__post card__post-list">
                                        <div class="image-sm">
                                            <a href="{{route('news-details' , $mostViewed->slug)}}">
                                                <img src="{{asset(env('NEWS_IMAGE_UPLOAD_PATH').$mostViewed->image)}}" alt="" class="img-fluid">
                                            </a>
                                        </div>

                                        <div class="card__post__body ">
                                            <div class="card__post__content">
                                                <div class="card__post__author-info mb-2">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span class="text-primary">
                                                                {{__('by')}} {{$mostViewed->author->name}}
                                                            </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span class="text-dark text-capitalize">
                                                                {{date('F d, Y' , strtotime($mostViewed->created_at))}}
                                                            </span>
                                                        </li>

                                                    </ul>
                                                </div>
                                                <div class="card__post__title">
                                                    <h6>
                                                        <a href="{{route('news-details' , $mostViewed->slug)}}">
                                                            {!!limitText($mostViewed->title)!!}
                                                        </a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </aside>

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">{{__('stay conected')}}</h4>
                            <!-- widget Social media -->
                            <div class="wrap__social__media">
                                @foreach ($socialCounts as $socialCount)

                                <a href="{{$socialCount->url}}" target="_blank">
                                    <div class="social__media__widget mt-2" style="background-color: {{$socialCount->color}};">
                                        <span class="social__media__widget-icon">
                                            <i class="{{$socialCount->icon}}"></i>
                                        </span>
                                        <span class="social__media__widget-counter">
                                            {{$socialCount->fan_count}} {{$socialCount->fan_type}}
                                        </span>
                                        <span class="social__media__widget-name">
                                            {{$socialCount->button_text}}
                                        </span>
                                    </div>
                                </a>
                                @endforeach

                            </div>
                        </aside>

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">{{__('tags')}}</h4>
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
                            <h4 class="border_section">Advertise</h4>
                            <a href="#">
                                <figure>
                                    <img src="{{asset('frontend/assets/images/newsimage3.png')}}" alt="" class="img-fluid">
                                </figure>
                            </a>
                        </aside>

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">{{__('newsletter')}}</h4>
                            <!-- Form Subscribe -->
                            <div class="widget__form-subscribe bg__card-shadow">
                                <h6>
                                    {{__('The most important world news and events of the day').}}
                                </h6>
                                <p><small>{{__('Get magzrenvi daily newsletter on your inbox')}}.</small></p>
                                <div class="input-group ">
                                    <input type="text" class="form-control" placeholder="Your email address">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">{{__('sign up')}}</button>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>


                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>
