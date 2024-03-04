@extends('admin.layouts.master')
@section('title', '- Create Language')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{route('admin.language.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>{{__('admin_localize.Create Language')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{__('admin_localize.Add Language')}}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.language.store') }}" method="post">
                                @csrf

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('admin_localize.Language')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="lang" id="language_select" class="form-control select2">
                                            <option value="">--Select--</option>
                                            @foreach (config('language') as $key => $language)

                                            <option value="{{$key}}">{{$language['name']}}</option>
                                            @endforeach
                                        </select>
                                        @error('lang')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('admin_localize.Name')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="name" id="name" type="text" class="form-control" readonly>
                                        @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('admin_localize.Slug')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input name="slug" id="slug" type="text" class="form-control" readonly>
                                        @error('slug')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('admin_localize.Is it default')}} ?</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="default" class="form-control selectric">

                                            <option value="0">{{__('admin_localize.No')}}</option>
                                            <option value="1">{{__('admin_localize.Yes')}}</option>
                                        </select>
                                        @error('default')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('admin_localize.Status')}}</label>
                                    <div class="col-sm-12 col-md-7">
                                      <select name="status" class="form-control selectric">
                                        <option value="">{{__('admin_localize.Select')}}</option>
                                        <option value="1">{{__('admin_localize.Active')}}</option>
                                        <option value="0">{{__('admin_localize.InActive')}}</option>
                                      </select>
                                      @error('status')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
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
             $('#language_select').on('change' , function(){
                let value = $(this).val()
                let name = $(this).children(':selected').text()
                $('#slug').val(value)
                $('#name').val(name)
             })
        })
    </script>
@endpush
