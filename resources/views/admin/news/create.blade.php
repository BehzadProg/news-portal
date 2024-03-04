@extends('admin.layouts.master')
@section('title', __('admin_localize.Create News'))
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{route('admin.news.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>{{__('admin_localize.News')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{__('admin_localize.Create News')}}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.news.store') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('admin_localize.Language')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="language" id="select-language" class="form-control select2">
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
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('admin_localize.Category')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                      <select name="category" id="category" class="form-control select2">
                                        <option value="">--{{__('admin_localize.Select')}}--</option>
                                      </select>
                                      @error('category')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('admin_localize.Image')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                      <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label">{{__('admin_localize.Choose File')}}</label>
                                        <input type="file" name="image" id="image-upload" />
                                      </div>
                                      @error('image')
                                      <p class="text-danger">{{$message}}</p>
                                      @enderror
                                    </div>
                                  </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('admin_localize.Title')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="title" type="text" value="{{old('title')}}" class="form-control">
                                        @error('title')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('admin_localize.Content')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="content" class="summernote" cols="30" rows="10">{{old('content')}}</textarea>
                                        @error('content')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('admin_localize.Tags')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                      <input type="text" name="tags" class="form-control inputtags">
                                      @error('tags')
                                      <p class="text-danger" style="margin-bottom: 0">{{$message}}</p>
                                      @enderror
                                      <code>{{__('admin_localize.Use comma , to create tag not enter key')}}</code>
                                    </div>
                                  </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('admin_localize.Meta Title')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="meta_title" value="{{old('meta_title')}}" type="text" class="form-control">
                                        @error('meta_title')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('admin_localize.Meta Description')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="meta_description" class="form-control" cols="30" rows="10">{{old('meta_description')}}</textarea>
                                        @error('meta_description')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4 ml-5">
                                    <div class="col-md-6">
                                        <div class="form-group text-center">
                                            <div class="control-label">{{__('admin_localize.Status')}}</div>
                                            <label class="custom-switch mt-2">
                                              <input value="1" type="checkbox" name="status" class="custom-switch-input">
                                              <span class="custom-switch-indicator"></span>
                                            </label>
                                          </div>
                                    </div>
                                    @if (canAccess(['news all-access' , 'news status']))
                                    <div class="col-md-6">
                                        <div class="form-group text-center">
                                            <div class="control-label">{{__('admin_localize.Is Breaking News')}}</div>
                                            <label class="custom-switch mt-2">
                                              <input value="1" type="checkbox" name="is_breaking_news" class="custom-switch-input">
                                              <span class="custom-switch-indicator"></span>
                                            </label>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group text-center">
                                            <div class="control-label">{{__('admin_localize.Show At Slider')}}</div>
                                            <label class="custom-switch mt-2">
                                              <input value="1" type="checkbox" name="show_at_slider" class="custom-switch-input">
                                              <span class="custom-switch-indicator"></span>
                                            </label>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group text-center">
                                            <div class="control-label">{{__('admin_localize.Show At Popular')}}</div>
                                            <label class="custom-switch mt-2">
                                              <input value="1" type="checkbox" name="show_at_popular" class="custom-switch-input">
                                              <span class="custom-switch-indicator"></span>
                                            </label>
                                          </div>
                                    </div>
                                    @endif
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
@push('scripts')
    <script>
        $(document).ready(function(){
            $('#select-language').on('change' , function(){
                let lang = $(this).val()

                $.ajax({
                    method:'GET',
                    url: "{{route('admin.fetch-category')}}",
                    data:{lang:lang},
                    success:function(data){
                        $('#category').html("")
                        $('#category').html(`<option value="">--{{__('admin_localize.Select')}}--</option>`)
                        $.each(data , function(index,data){
                            $('#category').append(`<option value="${data.id}">${data.name}</option>`)
                        })
                    },
                    error:function(data){
                        console.log(data);
                    }
                })
            })
        })
    </script>
@endpush
