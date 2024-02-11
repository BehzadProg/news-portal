@extends('admin.layouts.master')
@section('title', __('- Create Role With Permission'))
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{route('admin.role.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>{{__('Role And Permission')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{__('Create Role With Permission')}}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.role.store') }}" method="post">
                                @csrf

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Role Name')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="role" type="text" value="{{old('role')}}" class="form-control">
                                        @error('role')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                @foreach ($permissions as $groupName => $permission)

                                <h6 class="mb-3">{{$groupName}}</h6>

                                <div class="form-group row mb-4 ml-5">
                                    @foreach ($permission as $item)

                                    <div class="col-md-3">
                                        <div class="form-group text-center">
                                            <div class="control-label">{{$item->name}}</div>
                                            <label class="custom-switch mt-2">
                                              <input value="{{$item->name}}" type="checkbox" name="permissions[]" class="custom-switch-input">
                                              <span class="custom-switch-indicator"></span>
                                            </label>
                                          </div>
                                    </div>
                                    @endforeach

                                </div>
                                @endforeach

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary">{{__('Create')}}</button>
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
