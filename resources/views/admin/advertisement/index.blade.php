@extends('admin.layouts.master')
@section('title', __('- Advertisement'))
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Advertisement') }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('Update Advertisement') }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.advertisement.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-4">
                                    <h6>{{ __('Home Page Ads') }}</h6>
                                </div>
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <img width="150px" src="{{asset(env('AD_IMAGE_UPLOAD_PATH').$ad->home_topbar_ad)}}" alt="">
                                </div>
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Topbar ad') }}</label>

                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" name="home_topbar_ad" id="image-upload" />
                                        @error('home_topbar_ad')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Topbar ad url') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="home_topbar_ad_url" type="text" value="{{ $ad->home_topbar_ad_url }}"
                                            class="form-control">
                                        @error('home_topbar_ad_url')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4 ml-3">
                                    <div class="col-md-6">
                                        <div class="form-group text-center">
                                            <div class="control-label">{{ __('Topbar ad Status') }}</div>
                                            <label class="custom-switch mt-2">
                                                <input value="1" type="checkbox" {{$ad->home_topbar_ad_status == 1 ? 'checked' : ''}} name="home_topbar_ad_status"
                                                    class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <img width="150px" src="{{asset(env('AD_IMAGE_UPLOAD_PATH').$ad->home_middle_ad)}}" alt="">
                                </div>
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Middle ad') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" name="home_middle_ad" id="image-upload" />
                                        @error('home_middle_ad')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Middle ad url') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="home_middle_ad_url" type="text" value="{{ $ad->home_middle_ad_url }}"
                                            class="form-control">
                                        @error('home_middle_ad_url')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row ml-3">
                                    <div class="col-md-6">
                                        <div class="form-group text-center">
                                            <div class="control-label">{{ __('Middle ad Status') }}</div>
                                            <label class="custom-switch mt-2">
                                                <input value="1" type="checkbox"  {{$ad->home_middle_ad_status == 1 ? 'checked' : ''}} name="home_middle_ad_status"
                                                    class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="form-group row mb-4">
                                    <h6>{{ __('News View Page Ad') }}</h6>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <img width="150px" src="{{asset(env('AD_IMAGE_UPLOAD_PATH').$ad->view_page_ad)}}" alt="">
                                </div>
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Bottom ad') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" name="view_page_ad" id="image-upload" />
                                        @error('view_page_ad')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Bottom ad url') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="view_page_ad_url" type="text" value="{{ $ad->view_page_ad_url }}"
                                            class="form-control">
                                        @error('view_page_ad_url')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row ml-3">
                                    <div class="col-md-6">
                                        <div class="form-group text-center">
                                            <div class="control-label">{{ __('Status') }}</div>
                                            <label class="custom-switch mt-2">
                                                <input value="1" type="checkbox" name="view_page_ad_status" {{$ad->view_page_ad_status == 1 ? 'checked' : ''}}
                                                    class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row mb-4">
                                    <h6>{{ __('News Page Ad') }}</h6>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <img width="150px" src="{{asset(env('AD_IMAGE_UPLOAD_PATH').$ad->news_page_ad)}}" alt="">
                                </div>
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Bottom ad') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" name="news_page_ad" id="image-upload" />
                                        @error('news_page_ad')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Bottom ad url') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="news_page_ad_url" type="text" value="{{ $ad->news_page_ad_url }}"
                                            class="form-control">
                                        @error('news_page_ad_url')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row ml-3">
                                    <div class="col-md-6">
                                        <div class="form-group text-center">
                                            <div class="control-label">{{ __('Status') }}</div>
                                            <label class="custom-switch mt-2">
                                                <input value="1" type="checkbox" name="news_page_ad_status" {{$ad->news_page_ad_status == 1 ? 'checked' : ''}}
                                                    class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row mb-4">
                                    <h6>{{ __('Sidebar Ad') }}</h6>
                                </div>
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <img width="150px" src="{{asset(env('AD_IMAGE_UPLOAD_PATH').$ad->sidebar_ad)}}" alt="">
                                </div>
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Sidebar ad') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" name="sidebar_ad" id="image-upload" />
                                        @error('sidebar_ad')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Sidebar ad url') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="sidebar_ad_url" type="text" value="{{ $ad->sidebar_ad_url }}"
                                            class="form-control">
                                        @error('sidebar_ad_url')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row ml-3">
                                    <div class="col-md-6">
                                        <div class="form-group text-center">
                                            <div class="control-label">{{ __('Status') }}</div>
                                            <label class="custom-switch mt-2">
                                                <input value="1" type="checkbox" name="sidebar_ad_status" {{$ad->sidebar_ad_status == 1 ? 'checked' : ''}}
                                                    class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary">{{ __('Update') }}</button>
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
        $(document).ready(function() {
            $('#select-language').on('change', function() {
                let lang = $(this).val()

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.fetch-category') }}",
                    data: {
                        lang: lang
                    },
                    success: function(data) {
                        $('#category').html("")
                        $('#category').html(
                            `<option value="">--{{ __('Select') }}--</option>`)
                        $.each(data, function(index, data) {
                            $('#category').append(
                                `<option value="${data.id}">${data.name}</option>`)
                        })
                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            })
        })
    </script>
@endpush
