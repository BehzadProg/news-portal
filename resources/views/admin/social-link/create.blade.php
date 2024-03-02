@extends('admin.layouts.master')
@section('title', __('Create Social Link'))
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{route('admin.social-link.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>{{__('Social Link')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{__('Create Social Link')}}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.social-link.store') }}" method="post">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Icon')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary" name="icon" role="iconpicker"></button>
                                        @error('icon')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Url')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="url" type="text" class="form-control">
                                        @error('url')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Status')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                      <select name="status" class="form-control selectric">
                                        <option value="">{{__('Select')}}</option>
                                        <option value="1">{{__('Active')}}</option>
                                        <option value="0">{{__('InActive')}}</option>
                                      </select>
                                      @error('status')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                  </div>

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
