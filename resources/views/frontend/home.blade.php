@extends('frontend.layouts.master')
@section('title' , '- Home')
@section('content')
    <!-- Tranding news  carousel-->
    @include('frontend.homeComponents.tranding-news')
    <!-- End Tranding news carousel -->

    <!-- Hero news Section -->
    @include('frontend.homeComponents.hero-slider')
    <!-- End Hero news Section -->

    <div class="large_add_banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="large_add_banner_img">
                        <img src="images/placeholder_large.jpg" alt="adds">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular news category -->
    @include('frontend.homeComponents.main-news')
    <!-- End Popular news category -->
@endsection
