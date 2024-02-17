<div class="tab-pane fade {{session()->has('setting_list_style') && session()->get('setting_list_style') == 'profile' ? 'show active' : ''}}" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">

    <div class="card boarder">
        <div class="card-body">
            <form action="{{route('admin.seo-setting.update')}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Site Seo Title')}}</label>
                    <div class="col-sm-12 col-md-7">
                        <input name="site_seo_title" type="text" value="{{$settings['site_seo_title']}}" class="form-control">
                        @error('site_seo_title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Site Seo Description')}}</label>
                    <div class="col-sm-12 col-md-7">
                        <textarea name="site_seo_description" class="form-control" id="" cols="30" rows="10">{{$settings['site_seo_description']}}</textarea>
                        @error('site_seo_description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Site Seo Keywords')}}</label>
                    <div class="col-sm-12 col-md-7">
                        <input name="site_seo_keywords" type="text" value="{{$settings['site_seo_keywords']}}" class="form-control inputtags">
                        @error('site_seo_keywords')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                    <div class="col-sm-12 col-md-7">
                        <button class="btn btn-primary">{{__('Save')}}</button>
                    </div>
                </div>

            </form>
        </div>
    </div>


</div>
