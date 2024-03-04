@php
    $footerInfo = \App\Models\FooterInfo::where('language' , getLanguage())->first();
    $gridOneTitle = \App\Models\FooterTitle::where(['language' => getLanguage() , 'key' => 'grid_one_title'])->first();
    $gridTwoTitle = \App\Models\FooterTitle::where(['language' => getLanguage() , 'key' => 'grid_two_title'])->first();
    $gridThreeTitle = \App\Models\FooterTitle::where(['language' => getLanguage() , 'key' => 'grid_three_title'])->first();
    $footerGridOne = \App\Models\FooterGridOne::where(['language' => getLanguage() , 'status' => 1])->get();
    $footerGridTwo = \App\Models\FooterGridTwo::where(['language' => getLanguage() , 'status' => 1])->get();
    $footerGridThree = \App\Models\FooterGridThree::where(['language' => getLanguage() , 'status' => 1])->get();
@endphp
<section class="wrapper__section p-0">
    <div class="wrapper__section__components">
        <!-- Footer -->
        <footer>
            <div class="wrapper__footer bg__footer-dark pb-0">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="widget__footer">
                                <figure class="image-logo">
                                    <img src="{{asset(env('SITE_LOGO_IMAGE_UPLOAD_PATH').@$footerInfo->logo)}}" alt="" class="logo-footer">
                                </figure>

                                <p>{!!@$footerInfo->description!!}</p>


                                <div class="social__media mt-4">
                                    <ul class="list-inline">
                                        @foreach ($socialLinks as $socialLink)

                                        <li class="list-inline-item">
                                            <a href="{{$socialLink->url}}" class="btn btn-social rounded text-white">
                                                <i class="{{$socialLink->icon}}"></i>
                                            </a>
                                        </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="widget__footer">
                                <div class="dropdown-footer">
                                    <h4 class="footer-title">
                                        {{@$gridOneTitle->value}}
                                        <span class="fa fa-angle-down"></span>
                                    </h4>

                                </div>

                                <ul class="list-unstyled option-content is-hidden">
                                    @foreach ($footerGridOne as $gridOne)

                                    <li>
                                        <a href="{{$gridOne->url}}">{{$gridOne->name}}</a>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="widget__footer">
                                <div class="dropdown-footer">
                                    <h4 class="footer-title">
                                        {{@$gridTwoTitle->value}}
                                        <span class="fa fa-angle-down"></span>
                                    </h4>

                                </div>
                                <ul class="list-unstyled option-content is-hidden">
                                    @foreach ($footerGridTwo as $gridTwo)

                                    <li>
                                        <a href="{{$gridTwo->url}}">{{$gridTwo->name}}</a>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="widget__footer">
                                <div class="dropdown-footer">
                                    <h4 class="footer-title">
                                        {{@$gridThreeTitle->value}}
                                        <span class="fa fa-angle-down"></span>
                                    </h4>

                                </div>

                                <ul class="list-unstyled option-content is-hidden">
                                    @foreach ($footerGridThree as $gridThree)

                                    <li>
                                        <a href="{{$gridThree->url}}">{{$gridThree->name}}</a>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer bottom -->
            <div class="wrapper__footer-bottom bg__footer-dark">
                <div class="container ">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="border-top-1 bg__footer-bottom-section">
                                <p class="text-white text-center">
                                    {{@$footerInfo->copyright}}</p>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </footer>
    </div>
</section>
