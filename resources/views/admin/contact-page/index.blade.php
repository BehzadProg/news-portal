@extends('admin.layouts.master')
@section('title', __('Contact Page'))
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Contact Page') }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('Update Contact Info') }}</h4>
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
                                        $contact = \App\Models\Contact::where('language', $language->lang)->first();
                                    @endphp

                                    <div class="tab-pane fade {{ $loop->index === 0 ? 'show active' : '' }} "
                                        id="home-{{ $language->lang }}" role="tabpanel" aria-labelledby="home-tab2">
                                        <div class="card-body">
                                            <form action="{{ route('admin.contact.update') }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Address') }}</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <textarea name="address" class="form-control" cols="30" rows="10">{!! @$contact->address !!}</textarea>
                                                        <input type="hidden" name="language" value="{{$language->lang}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Phone') }}</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input type="text" name="phone" class="form-control" value="{{@$contact->phone}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Email') }}</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input type="text" name="email" class="form-control"  value="{{@$contact->email}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <button class="btn btn-primary">{{ __('Save') }}</button>
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
