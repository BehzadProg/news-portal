@extends('admin.layouts.master')
@section('title', __('admin_localize.Footer Info'))
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin_localize.Footer Info') }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('admin_localize.Update Footer Info') }}</h4>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                @foreach ($languages as $language)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $loop->index === 0 ? 'active' : '' }}" id="home-tab2"
                                            data-toggle="tab" href="#home-{{ $language->lang }}" role="tab"
                                            aria-controls="home" aria-selected="true">{{ $language->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content tab-bordered" id="myTab3Content">
                                @foreach ($languages as $language)
                                    @php
                                        $footerInfo = \App\Models\FooterInfo::where('language', $language->lang)->first();

                                    @endphp

                                    <div class="tab-pane fade {{ $loop->index === 0 ? 'show active' : '' }} "
                                        id="home-{{ $language->lang }}" role="tabpanel" aria-labelledby="home-tab2">
                                        <div class="card-body">
                                            <form action="{{ route('admin.footer-info.store') }}" method="POST" enctype="multipart/form-data">
                                                @csrf

                                                @if (@$footerInfo->logo)

                                                <div class="form-group row mb-4">
                                                    <label
                                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                                <img width="150px" src="{{asset(env('SITE_LOGO_IMAGE_UPLOAD_PATH').@$footerInfo->logo)}}" alt="">
                                                </div>
                                                @endif
                                                <div class="form-group row mb-4">
                                                    <label
                                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('admin_localize.Logo') }}</label>

                                                    <div class="col-sm-12 col-md-7">
                                                        <input type="file" name="logo" id="image-upload" />
                                                        <input name="lang" type="hidden" value="{{$language->lang}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('admin_localize.Description')}}</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <textarea name="description" class="form-control" cols="30" rows="10">{!!@$footerInfo->description!!}</textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('admin_localize.CopyRight Text')}}</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input name="copyright" type="text" value="{{@$footerInfo->copyright}}" class="form-control">

                                                    </div>
                                                </div>


                                                <div class="form-group row mb-4">
                                                    <label
                                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <button class="btn btn-primary">{{ __('admin_localize.Save') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                Toast.fire({
                    icon: 'error',
                    title: '{{ $error }}'
                });
            @endforeach
        @endif
    </script>
@endpush
