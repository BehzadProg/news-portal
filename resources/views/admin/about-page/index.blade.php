@extends('admin.layouts.master')
@section('title', __('About Page'))
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('About Page') }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('Update About Content') }}</h4>
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
                                        $about = \App\Models\About::where('language', $language->lang)->first();
                                    @endphp

                                    <div class="tab-pane fade {{ $loop->index === 0 ? 'show active' : '' }} "
                                        id="home-{{ $language->lang }}" role="tabpanel" aria-labelledby="home-tab2">
                                        <div class="card-body">
                                            <form action="{{ route('admin.about.update') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group mb-4">
                                                    <label>{{ __('About Content') }}</label>

                                                    <textarea name="content" class="summernote-{{$language->lang}}" cols="30" rows="10">{!! @$about->content !!}</textarea>
                                                    <input type="hidden" name="language" value="{{$language->lang}}">
                                                </div>

                                                <div class="form-group">
                                                    <button class="btn btn-primary">{{ __('Save') }}</button>
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

        if (jQuery().summernote) {
                @foreach ($languages as $language)
                $(".summernote-{{$language->lang}}").summernote({
                    dialogsInBody: true,
                    minHeight: 250,
                });
                @endforeach
            }
    </script>
@endpush
