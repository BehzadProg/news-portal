@extends('frontend.layouts.master')
@section('title', 'Contact')
@section('content')
    <!-- Breadcrumb  -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Breadcrumb -->
                    <ul class="breadcrumbs bg-light mb-4">
                        <li class="breadcrumbs__item">
                            <a href="{{ url('/') }}" class="breadcrumbs__url">
                                <i class="fa fa-home"></i> {{ __('frontend_localize.Home') }}</a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="javascript:;" class="breadcrumbs__url">{{ __('frontend_localize.Contact') }}</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb  -->


    <!-- Form contact -->
    <section class="wrap__contact-form">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h5>{{ __('frontend_localize.contact us') }}</h5>
                    <form action="{{ route('contact.submit') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-name">
                                    <label>{{ __('frontend_localize.Your email') }} <span class="required"></span></label>
                                    <input type="email" class="form-control" name="email" required="">
                                    @error('email')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-group-name">
                                    <label>{{ __('frontend_localize.Subject') }} <span class="required"></span></label>
                                    <input type="text" class="form-control" name="subject" required="">
                                    @error('subject')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __('frontend_localize.Your message') }} </label>
                                    <textarea class="form-control" rows="8" name="message"></textarea>
                                    @error('message')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <button type="submit" class="btn btn-primary">{{ __('frontend_localize.Submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-4">
                    <h5>{{ __('frontend_localize.Info location') }}</h5>
                    <div class="wrap__contact-form-office">
                        <ul class="list-unstyled">
                            <li>
                                <span>
                                    <i class="fa fa-home"></i>
                                </span>

                                {!! @$contact->address !!}


                            </li>
                            <li>
                                <span>
                                    <i class="fa fa-phone"></i>
                                    <a href="tel:{{ @$contact->phone }}">{{ @$contact->phone }}</a>
                                </span>

                            </li>
                            <li>
                                <span>
                                    <i class="fa fa-envelope"></i>
                                    <a href="mailto:{{ @$contact->email }}">{{ @$contact->email }}</a>
                                </span>

                            </li>
                        </ul>

                        <div class="social__media">
                            <h5>{{ __('frontend_localize.find us') }}</h5>
                            <ul class="list-inline">
                                @foreach ($socialLinks as $socialLink)
                                    <li class="list-inline-item">
                                        <a href="{{ $socialLink->url }}" class="btn btn-social rounded text-white">
                                            <i class="{{ $socialLink->icon }}"></i>
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Form contact  -->
@endsection
