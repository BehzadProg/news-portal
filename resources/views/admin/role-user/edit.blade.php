@extends('admin.layouts.master')
@section('title', __('- Edit Role User'))
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{route('admin.role-users.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>{{__('Role Users')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{__('Update User With Role')}}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.role-users.update' , $admin->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('User Name')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="name" type="text" value="{{$admin->name}}" class="form-control">
                                        @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('User Email')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="email" type="text" value="{{$admin->email}}" class="form-control">
                                        @error('email')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Password')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="password" type="password" class="form-control">
                                        @error('password')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Confirm Password')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="password_confirmation" type="password" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Role')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="role" id="select-language" class="form-control select2">
                                            <option value="">--{{__('Select')}}--</option>
                                            @foreach ($roles as $role)

                                            <option {{$admin->getRoleNames()->first() == $role->name ? 'selected' : ''}} value="{{$role->name}}">{{$role->name}}</option>
                                            @endforeach

                                        </select>
                                        @error('role')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary">{{__('Update')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
