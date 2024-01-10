@extends('admin.layouts.master')
@section('title', __('- Create Social Count'))
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{route('admin.social-count.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>{{__('Social Count')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{__('Create Social Count')}}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.social-count.store') }}" method="post">
                                @csrf

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Language')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="language"  class="form-control select2">
                                            <option value="">--{{__('Select')}}--</option>
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
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Fan Count')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="fan_count" type="text" class="form-control">
                                        @error('fan_count')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Fan Type')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="fan_type" type="text" placeholder="ex : Likes Fans Followers" class="form-control">
                                        @error('fan_type')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Button Text')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="button_text" type="text" placeholder="ex : Likes Fans Followers" class="form-control">
                                        @error('button_text')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Pick Your Color')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                         <div class="input-group colorpickerinput">
                                      <input type="text"name="color" class="form-control">
                                      <div class="input-group-append">
                                        <div class="input-group-text">
                                          <i class="fas fa-fill-drip"></i>
                                        </div>
                                      </div>
                                    </div>
                                        @error('color')
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
@push('scripts')
<script>
    $(".colorpickerinput").colorpicker({
    format: 'hex',
    component: '.input-group-append',
    });
</script>
@endpush
