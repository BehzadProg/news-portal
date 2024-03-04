@extends('frontend.layouts.master')
@section('title' , __('frontend_localize.sign up'))
@section('content')
    <!-- login -->
    <section class="wrap__section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mx-auto" style="max-width: 380px;">
                        <div class="card-body">
                            <h4 class="card-title mb-4">{{__('frontend_localize.sign up')}}</h4>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" placeholder="{{__('frontend_localize.Name')}}" type="text" name="name" value="{{old('name')}}">
                                    @if ($errors->first('name'))
                                    <code>{{$errors->first('name')}}</code>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="{{__('frontend_localize.Email')}}" type="email" name="email" value="{{old('email')}}">
                                    @if ($errors->first('email'))
                                    <code>{{$errors->first('email')}}</code>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="{{__('frontend_localize.Password')}}" type="password" name="password">
                                    @if ($errors->first('password'))
                                    <code>{{$errors->first('password')}}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input class="form-control" placeholder="{{__('frontend_localize.Password confirmation')}}" type="password" name="password_confirmation">
                                    @if ($errors->first('password_confirmation'))
                                    <code>{{$errors->first('password_confirmation')}}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <a href="{{ route('login') }}" class="float-right">{{__('frontend_localize.Already registered')}}?</a>
                                    <label class="float-left custom-control custom-checkbox"></label>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block"> {{__('frontend_localize.Register')}} </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end login -->
@endsection
