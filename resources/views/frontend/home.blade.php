@extends('frontend.layouts.master')
@section('title' , 'Home')
@section('content')
    <!-- Breaking news  carousel-->
    @include('frontend.homeComponents.breaking-news')
    <!-- End Breaking news carousel -->

    <!-- Hero news Section -->
    @include('frontend.homeComponents.hero-slider')
    <!-- End Hero news Section -->

    @if ($ad->home_topbar_ad_status == 1)
    <div class="large_add_banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="large_add_banner_img">
                        <a href="{{$ad->home_topbar_ad_url}}">
                            <img src="{{asset(env('AD_IMAGE_UPLOAD_PATH').$ad->home_topbar_ad)}}" alt="adds">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Popular news category -->
    @include('frontend.homeComponents.main-news')
    <!-- End Popular news category -->
@endsection
