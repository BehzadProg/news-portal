@extends('frontend.layouts.master')
@section('title' , __('frontend_localize.Reset Password'))
@section('content')
    <!-- login -->
    <section class="wrap__section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mx-auto" style="max-width: 380px;">
                        <div class="card-body">
                            <h4 class="card-title mb-4">{{__('frontend_localize.Reset Password')}}</h4>
                            <form method="POST" action="{{ route('password.store') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                <div class="form-group">
                                    <input class="form-control" placeholder="{{__('frontend_localize.Email')}}" type="email" name="email" value="{{old('email' , $request->email)}}">
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
                                    <button type="submit" class="btn btn-primary btn-block"> {{__('frontend_localize.Reset Password')}} </button>
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
