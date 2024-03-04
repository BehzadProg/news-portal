@extends('admin.layouts.master')
@section('title', __('admin_localize.Create Category'))
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{route('admin.category.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>{{__('admin_localize.Category')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{__('admin_localize.Create Category')}}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.category.store') }}" method="post">
                                @csrf

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('admin_localize.Language')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="language"  class="form-control select2">
                                            <option value="">--{{__('admin_localize.Select')}}--</option>
                                            @foreach ($languages as $language)

                                            <option value="{{$language->lang}}">{{$language->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('language')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('admin_localize.Name')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="name" type="text" class="form-control">
                                        @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('admin_localize.Show At Nav')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="show_at_nav" class="form-control selectric">

                                            <option value="0">{{__('admin_localize.No')}}</option>
                                            <option value="1">{{__('admin_localize.Yes')}}</option>
                                        </select>
                                        @error('default')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('admin_localize.Status')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                      <select name="status" class="form-control selectric">
                                        <option value="">{{__('admin_localize.Select')}}</option>
                                        <option value="1">{{__('admin_localize.Active')}}</option>
                                        <option value="0">{{__('admin_localize.InActive')}}</option>
                                      </select>
                                      @error('status')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                  </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary">{{__('admin_localize.Create')}}</button>
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
