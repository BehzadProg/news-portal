@extends('admin.layouts.master')
@section('title' , __('admin_localize.Profile'))
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin_localize.Profile')}}</h1>
        </div>
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form method="post" class="needs-validation" novalidate=""
                            action="{{route('admin.profile.update' , $user->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>{{__('admin_localize.Update Profile')}}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-8 col-12">
                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">{{__('admin_localize.Choose File')}}</label>
                                            <input type="file" name="image" id="image-upload">
                                        </div>
                                        @if ($errors->has('image'))
                                        <code>{{ $errors->first('image') }}</code>
                                    @endif
                                    </div>
                                    <div class="form-group col-md-8 col-12">
                                        <label>{{__('admin_localize.Name')}}</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $user->name }}">
                                        @if ($errors->has('name'))
                                            <code>{{ $errors->first('name') }}</code>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-8 col-12">
                                        <label>{{__('admin_localize.Email')}}</label>
                                        <input type="text" name="email" class="form-control"
                                            value="{{ $user->email }}">
                                        @if ($errors->has('email'))
                                            <code>{{ $errors->first('email') }}</code>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">{{__('admin_localize.Save Changes')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form method="post" class="needs-validation" novalidate=""
                            action="{{route('admin.profile-update-password' , $user->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>{{__('admin_localize.Update Password')}}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-md-8 col-12">
                                        <label>{{__('admin_localize.Current Password')}}</label>
                                        <input type="password" name="current_password" class="form-control">
                                        @if ($errors->has('current_password'))
                                            <code>{{ $errors->first('current_password') }}</code>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-8 col-12">
                                        <label>{{__('admin_localize.New Password')}}</label>
                                        <input type="password" name="password" class="form-control">
                                        @if ($errors->has('password'))
                                            <code>{{ $errors->first('password') }}</code>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-8 col-12">
                                        <label>{{__('admin_localize.Confirm Password')}}</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                        @if ($errors->has('password_confirmation'))
                                            <code>{{ $errors->first('password_confirmation') }}</code>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">{{__('admin_localize.Change')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $('.image-preview').css({
                "background-image": "url({{asset(env('ADMIN_PROFILE_IMAGE_UPLOAD_PATH').$user->image)}})",
                "background-size": "cover",
                "background-position": "center center"
            })
        })
    </script>
@endpush
