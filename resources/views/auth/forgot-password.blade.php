@extends('frontend.layouts.master')
@section('title' , __('frontend_localize.Forgot Password'))
@section('content')
    <!-- login -->
    <section class="wrap__section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mx-auto" style="max-width: 380px;">
                        <div class="card-body">
                            <h4 class="card-title mb-4">{{__('frontend_localize.Forgot Password')}}</h4>
                            @if(session('status'))
                            <div class="alert alert-success">
                                {{session('status')}}
                            </div>
                            @endif
                            <form  method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" placeholder="{{__('frontend_localize.Email')}}" type="email" name="email" value="{{old('email')}}">
                                    @if ($errors->first('email'))
                                    <code>{{$errors->first('email')}}</code>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {{ __('frontend_localize.Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block"> {{__('frontend_localize.Send Reset Link')}} </button>
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
