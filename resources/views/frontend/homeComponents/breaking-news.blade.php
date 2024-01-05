<section class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="wrapp__list__article-responsive wrapp__list__article-responsive-carousel">
                    @foreach ($news as $new)

                    <div class="item">
                        <!-- Post Article -->
                        <div class="card__post card__post-list">
                            <div class="image-sm">
                                <a href="{{route('news-details' , $new->slug)}}">
                                    <img src="{{asset(env('NEWS_IMAGE_UPLOAD_PATH').$new->image)}}" class="img-fluid" alt="">
                                </a>
                            </div>

                            <div class="card__post__body ">
                                <div class="card__post__content">

                                    <div class="card__post__author-info mb-2">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <span class="text-primary">
                                                    {{__('by')}} {{$new->author->name}}
                                                </span>
                                            </li>
                                            <li class="list-inline-item">
                                                <span class="text-dark text-capitalize">
                                                    {{date('M d, Y' , strtotime($new->created_at))}}
                                                </span>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="card__post__title">
                                        <h6>
                                            <a href="{{route('news-details' , $new->slug)}}">
                                                {!! limitText($new->title) !!}
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
