<section>
    <!-- Popular news  header-->
    <div class="popular__news-header">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-8 ">
                    <div class="card__post-carousel">
                        @foreach ($heroSlider as $slider)
                        @if($loop->index > 1 && $loop->index <= 7)
                        <div class="item">
                            <!-- Post Article -->
                            <div class="card__post">
                                <div class="card__post__body">
                                    <a href="{{route('news-details' , $slider->slug)}}">
                                        <img src="{{asset(env('NEWS_IMAGE_UPLOAD_PATH').$slider->image)}}" class="img-fluid" alt="">
                                    </a>
                                    <div class="card__post__content bg__post-cover">
                                        <div class="card__post__category">
                                            {{$slider->category->name}}
                                        </div>
                                        <div class="card__post__title">
                                            <h2>
                                                <a href="{{route('news-details' , $slider->slug)}}">
                                                    {!! limitText($slider->title) !!}
                                                </a>
                                            </h2>
                                        </div>
                                        <div class="card__post__author-info">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="javascript:;">
                                                        {{__('by')}} {{$slider->author->name}}
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <span>
                                                        {{date('F d, Y' , strtotime($slider->created_at))}}
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
                </div>
                <div class="col-md-4">
                    <div class="popular__news-right">
                        <!-- Post Article -->
                        @foreach ($heroSlider as $slider)
                        @if($loop->index <= 1)
                        <div class="card__post ">
                            <div class="card__post__body card__post__transition">
                                <a href="{{route('news-details' , $slider->slug)}}">
                                    <img src="{{asset(env('NEWS_IMAGE_UPLOAD_PATH').$slider->image)}}" class="img-fluid" alt="">
                                </a>
                                <div class="card__post__content bg__post-cover">
                                    <div class="card__post__category">
                                        {{$slider->category->name}}
                                    </div>
                                    <div class="card__post__title">
                                        <h5>
                                            <a href="{{route('news-details' , $slider->slug)}}">
                                                {!! limitText($slider->title) !!}
                                            </a>
                                        </h5>
                                    </div>
                                    <div class="card__post__author-info">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <a href="javascript:;">
                                                    {{__('by')}} {{$slider->author->name}}
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <span>
                                                    {{date('F d, Y' , strtotime($slider->created_at))}}
                                                </span>
                                            </li>
                                        </ul>
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
    </div>
    <!-- End Popular news header-->
</section>
