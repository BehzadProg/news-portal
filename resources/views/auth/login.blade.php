@extends('frontend.layouts.master')
@section('title' , __('frontend_localize.Login'))
@section('content')
    <!-- login -->
    <section class="wrap__section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mx-auto" style="max-width: 380px;">
                        <div class="card-body">
                            <h4 class="card-title mb-4">{{__('frontend_localize.sign in')}}</h4>
                            @if(session('status'))
                            <div class="alert alert-success">
                                {{session('status')}}
                            </div>
                            @endif
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                {{-- <a href="#" class="btn btn-facebook btn-block mb-2 text-white"> <i
                                        class="fa fa-facebook"></i> &nbsp; Sign
                                    in
                                    with
                                    Facebook</a>
                                <a href="#" class="btn btn-primary btn-block mb-4"> <i class="fa fa-google"></i> &nbsp;
                                    Sign in with
                                    Google</a> --}}
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
                                    <a href="{{ route('password.request') }}" class="float-right">{{__('frontend_localize.Forgot password')}}?</a>
                                    <label class="float-left custom-control custom-checkbox"> <input type="checkbox"
                                            class="custom-control-input" name="remember">
                                        <span class="custom-control-label"> {{__('frontend_localize.Remember')}} </span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block"> {{__('frontend_localize.Login')}} </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <p class="text-center mt-4 mb-0">{{__("frontend_localize.Don't have account")}}? <a href="{{route('register')}}">{{__('frontend_localize.sign up')}}</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- end login -->
@endsection
