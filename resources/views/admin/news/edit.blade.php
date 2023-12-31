@extends('admin.layouts.master')
@section('title', __('- Edit News'))
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{route('admin.news.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>{{__('News')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{__('Edit News')}}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.news.update' , $news->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Language')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="language" id="select-language" class="form-control select2">
                                            <option value="">--{{__('Select')}}--</option>
                                            @foreach ($languages as $language)

                                            <option {{$news->language === $language->lang ? 'selected' : ''}} value="{{$language->lang}}">{{$language->name}}</option>
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
                                      <select name="category" id="category" class="form-control select2">
                                        <option value="">--{{__('Select')}}--</option>
                                        @foreach ($categories as $category)
                                        <option {{$category->id === $news->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                      </select>
                                      @error('category')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Image')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                      <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label">{{__('Choose File')}}</label>
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
                                        <input name="title" type="text" value="{{$news->title}}" class="form-control">
                                        @error('title')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Content')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="content" class="summernote-simple" cols="30" rows="10">{{$news->content}}</textarea>
                                        @error('content')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Tags')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                      <input type="text" name="tags" value="{{formatTags($news->tags()->pluck('name')->toArray())}}" class="form-control inputtags">
                                      @error('tags')
                                      <p class="text-danger" style="margin-bottom: 0">{{$message}}</p>
                                      @enderror
                                      <code>{{__('Use comma , to create tag not enter key')}}</code>
                                    </div>
                                  </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Meta Title')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="meta_title" value="{{$news->meta_title}}" type="text" class="form-control">
                                        @error('meta_title')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Meta Description')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="meta_description" class="form-control" cols="30" rows="10">{{$news->meta_description}}</textarea>
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
                                              <input {{$news->status === 1 ? 'checked' : ''}} value="1" type="checkbox" name="status" class="custom-switch-input">
                                              <span class="custom-switch-indicator"></span>
                                            </label>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group text-center">
                                            <div class="control-label">{{__('Is Breaking News')}}</div>
                                            <label class="custom-switch mt-2">
                                              <input {{$news->is_breaking_news === 1 ? 'checked' : ''}} value="1" type="checkbox" name="is_breaking_news" class="custom-switch-input">
                                              <span class="custom-switch-indicator"></span>
                                            </label>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group text-center">
                                            <div class="control-label">{{__('Show At Slider')}}</div>
                                            <label class="custom-switch mt-2">
                                              <input {{$news->show_at_slider === 1 ? 'checked' : ''}} value="1" type="checkbox" name="show_at_slider" class="custom-switch-input">
                                              <span class="custom-switch-indicator"></span>
                                            </label>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group text-center">
                                            <div class="control-label">{{__('Show At Popular')}}</div>
                                            <label class="custom-switch mt-2">
                                              <input {{$news->show_at_popular === 1 ? 'checked' : ''}} value="1" type="checkbox" name="show_at_popular" class="custom-switch-input">
                                              <span class="custom-switch-indicator"></span>
                                            </label>
                                          </div>
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
@push('scripts')
    <script>
        $(document).ready(function(){
            $('.image-preview').css({
                "background-image": "url({{asset(env('NEWS_IMAGE_UPLOAD_PATH').$news->image)}})",
                "background-size": "cover",
                "background-position": "center center"
            })


            $('#select-language').on('change' , function(){
                let lang = $(this).val()

                $.ajax({
                    method:'GET',
                    url: "{{route('admin.fetch-category')}}",
                    data:{lang:lang},
                    success:function(data){
                        $('#category').html("")
                        $('#category').html(`<option value="">--{{__('Select')}}--</option>`)
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
