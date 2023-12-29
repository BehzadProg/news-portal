@extends('admin.layouts.master')
@section('title', __('- Create News'))
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{route('admin.category.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>{{__('News')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{__('Create News')}}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.news.store') }}" method="post">
                                @csrf

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Language')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="language"  class="form-control select2">
                                            <option value="">--Select--</option>
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
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Category')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                      <select name="category" class="form-control selectric">
                                        <option value="">{{__('Select')}}</option>
                                      </select>
                                      @error('category')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                                    <div class="col-sm-12 col-md-7">
                                      <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label">Choose File</label>
                                        <input type="file" name="image" id="image-upload" />
                                      </div>
                                      @error('image')
                                      <p class="text-danger">{{$message}}</p>
                                      @enderror
                                    </div>
                                  </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Title')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="title" type="text" class="form-control">
                                        @error('title')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Content')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="content" class="summernote-simple" cols="30" rows="10"></textarea>
                                        @error('content')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Meta Title')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="meta_title" type="text" class="form-control">
                                        @error('meta_title')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Meta Description')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="meta_description" class="form-control" cols="30" rows="10"></textarea>
                                        @error('meta_description')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4 ml-5">
                                    <div class="col-md-6">
                                        <div class="form-group text-center">
                                            <div class="control-label">{{__('Status')}}</div>
                                            <label class="custom-switch mt-2">
                                              <input type="checkbox" name="status" class="custom-switch-input">
                                              <span class="custom-switch-indicator"></span>
                                              @error('status')
                                              <span class="custom-switch-description text-danger">{{$message}}</span>
                                              @enderror
                                            </label>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group text-center">
                                            <div class="control-label">{{__('Is Breaking News')}}</div>
                                            <label class="custom-switch mt-2">
                                              <input type="checkbox" name="is_breaking_news" class="custom-switch-input">
                                              <span class="custom-switch-indicator"></span>
                                              @error('is_breaking_news')
                                              <span class="custom-switch-description text-danger">{{$message}}</span>
                                              @enderror
                                            </label>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group text-center">
                                            <div class="control-label">{{__('Show At Slider')}}</div>
                                            <label class="custom-switch mt-2">
                                              <input type="checkbox" name="show_at_slider" class="custom-switch-input">
                                              <span class="custom-switch-indicator"></span>
                                              @error('show_at_slider')
                                              <span class="custom-switch-description text-danger">{{$message}}</span>
                                              @enderror
                                            </label>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group text-center">
                                            <div class="control-label">{{__('Show At Popular')}}</div>
                                            <label class="custom-switch mt-2">
                                              <input type="checkbox" name="show_at_popular" class="custom-switch-input">
                                              <span class="custom-switch-indicator"></span>
                                              @error('show_at_popular')
                                              <span class="custom-switch-description text-danger">{{$message}}</span>
                                              @enderror
                                            </label>
                                          </div>
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
