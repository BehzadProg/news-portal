<div class="tab-pane fade {{session()->has('setting_list_style') && session()->get('setting_list_style') == 'settings' ? 'show active' : ''}}" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">

    <div class="card boarder">
        <div class="card-body">
            <form action="{{route('admin.appearance-setting.update')}}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{__('Site Theme Color')}}</label>
                    <div class="col-sm-12 col-md-7">
                         <div class="input-group colorpickerinput">
                      <input type="text" name="site_color" value="{{@$settings['site_color']}}" class="form-control">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <i class="fas fa-fill-drip"></i>
                        </div>
                      </div>
                    </div>
                        @error('site_color')
                        <p class="text-danger">{{$message}}</p>
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
@push('scripts')
<script>
    $(".colorpickerinput").colorpicker({
    format: 'hex',
    component: '.input-group-append',
    });
</script>
@endpush
