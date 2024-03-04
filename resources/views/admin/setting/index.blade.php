@extends('admin.layouts.master')
@section('title', __('admin_localize.Settings'))
@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{__('admin_localize.Settings')}}</h1>
    </div>
    <div class="section-body">
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-3">
                          <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action {{session()->has('setting_list_style') && session()->get('setting_list_style') == 'home' ? 'active' : ''}} list-view {{ !session()->has('setting_list_style') ? 'active' : '' }}" data-id="home" id="list-home-list" data-toggle="list" href="#list-home" role="tab">{{__('admin_localize.General Setting')}}</a>
                            <a class="list-group-item list-group-item-action {{session()->has('setting_list_style') && session()->get('setting_list_style') == 'profile' ? 'active' : ''}} list-view" data-id="profile" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab">{{__('admin_localize.Seo Settings')}}</a>
                            <a class="list-group-item list-group-item-action {{session()->has('setting_list_style') && session()->get('setting_list_style') == 'settings' ? 'active' : ''}} list-view" data-id="settings" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab">{{__('admin_localize.Appearance Setting')}}</a>
                          </div>
                        </div>
                        <div class="col-9">
                          <div class="tab-content" id="nav-tabContent">
                            @include('admin.setting.general-setting')

                            @include('admin.setting.seo-setting')

                            @include('admin.setting.appearance-setting')
                          </div>
                        </div>
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
        $(document).ready(function(){
        $('.list-view').on('click', function() {
                let style = $(this).data('id');

                $.ajax({
                    method: 'Get',
                    url: "{{route('admin.setting-change-view-list')}}",
                    data: {
                        style: style
                    },
                    success: function(data) {

                    }
                })

            })
    })
    </script>
@endpush
