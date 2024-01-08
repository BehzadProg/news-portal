@extends('admin.layouts.master')
@section('title', __('- Home Section Settings'))
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Home Section Settings') }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('Update Home Section Setting') }}</h4>
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
                                        $categories = \App\Models\Category::where('language', $language->lang)
                                            ->orderByDesc('id')
                                            ->get();
                                        $homeSectionSetting = \App\Models\HomeSectionSetting::where('language' , $language->lang)->first();
                                    @endphp

                                    <div class="tab-pane fade {{ $loop->index === 0 ? 'show active' : '' }} "
                                        id="home-{{ $language->lang }}" role="tabpanel" aria-labelledby="home-tab2">
                                        <div class="card-body">
                                            <form action="{{ route('admin.home-section-setting.update') }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group row mb-4">
                                                    <label
                                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Category Section One') }}</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input type="hidden" name="language" value="{{ $language->lang }}">
                                                        <select name="category_section_one" class="form-control select2">
                                                            <option value="">--{{ __('Select') }}--</option>
                                                            @foreach ($categories as $category)
                                                                <option {{$category->id === $homeSectionSetting->category_section_one ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="form-group row mb-4">
                                                    <label
                                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Category Section Two') }}</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <select name="category_section_two" class="form-control select2">
                                                            <option value="">--{{ __('Select') }}--</option>
                                                            @foreach ($categories as $category)
                                                                <option {{$category->id === $homeSectionSetting->category_section_two ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="form-group row mb-4">
                                                    <label
                                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Category Section Three') }}</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <select name="category_section_three" class="form-control select2">
                                                            <option value="">--{{ __('Select') }}--</option>
                                                            @foreach ($categories as $category)
                                                                <option {{$category->id === $homeSectionSetting->category_section_three ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="form-group row mb-4">
                                                    <label
                                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Category Section Four') }}</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <select name="category_section_four" class="form-control select2">
                                                            <option value="">--{{ __('Select') }}--</option>
                                                            @foreach ($categories as $category)
                                                                <option {{$category->id === $homeSectionSetting->category_section_four ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>


                                                <div class="form-group row mb-4">
                                                    <label
                                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <button class="btn btn-primary">{{ __('Update') }}</button>
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
