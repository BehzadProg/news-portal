@extends('admin.layouts.master')
@section('title', '- Edit Language')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{route('admin.language.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>{{__('Edit Language')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{__('Update Language')}}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.language.update' , $languages->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Language')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="lang" id="language_select" class="form-control select2">
                                            <option value="">--Select--</option>
                                            @foreach (config('language') as $key => $language)

                                            <option {{$languages->lang === $key ? 'selected' : ''}} value="{{$key}}">{{$language['name']}}</option>
                                            @endforeach
                                        </select>
                                        @error('lang')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Name')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="name" id="name" type="text" value="{{$languages->name}}" class="form-control" readonly>
                                        @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Slug')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="slug" id="slug" type="text" value="{{$languages->slug}}" class="form-control" readonly>
                                        @error('slug')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Is it default')}} ?</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="default" class="form-control selectric">

                                            <option {{$languages->default === 0 ? 'selected' : ''}} value="0">{{__('No')}}</option>
                                            <option {{$languages->default === 1 ? 'selected' : ''}} value="1">{{__('Yes')}}</option>
                                        </select>
                                        @error('default')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Status')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                      <select name="status" class="form-control selectric">
                                        <option value="">{{__('Select')}}</option>
                                        <option {{$languages->status === 1 ? 'selected' : ''}} value="1">{{__('Active')}}</option>
                                        <option {{$languages->status === 0 ? 'selected' : ''}} value="0">{{__('InActive')}}</option>
                                      </select>
                                      @error('status')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
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
             $('#language_select').on('change' , function(){
                let value = $(this).val()
                let name = $(this).children(':selected').text()
                $('#slug').val(value)
                $('#name').val(name)
             })
        })
    </script>
@endpush
