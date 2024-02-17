<div class="tab-pane fade {{session()->has('setting_list_style') && session()->get('setting_list_style') == 'home' ? 'show active' : ''}} {{ !session()->has('setting_list_style') ? 'show active' : '' }}" id="list-home" role="tabpanel" aria-labelledby="list-home-list">

    <div class="card boarder">
        <div class="card-body">
            <form action="{{route('admin.general-setting.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Site Name')}}</label>
                    <div class="col-sm-12 col-md-7">
                        <input name="site_name" type="text" value="{{$settings['site_name']}}" class="form-control">
                        @error('site_name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label
                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                <img width="150px"  src="{{asset(env('SITE_LOGO_IMAGE_UPLOAD_PATH').$settings['site_logo'])}}" alt="">
                </div>
                <div class="form-group row mb-4">
                    <label
                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Site Logo') }}</label>

                    <div class="col-sm-12 col-md-7">
                        <input type="file" name="site_logo" id="image-upload" />
                        @error('site_logo')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label
                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                <img width="100px"  src="{{asset(env('SITE_LOGO_IMAGE_UPLOAD_PATH').$settings['site_favicon'])}}" alt="">
                </div>
                <div class="form-group row mb-4">
                    <label
                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Site Favicon') }}</label>

                    <div class="col-sm-12 col-md-7">
                        <input type="file" name="site_favicon" id="image-upload" />
                        @error('site_favicon')
                            <p class="text-danger">{{ $message }}</p>
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
