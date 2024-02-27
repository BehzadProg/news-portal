@extends('admin.layouts.master')
@section('title', __('- Localization'))
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('Frontend Localization')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{__('All Strings')}}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.category.create') }}" class="btn btn-primary">{{__('Create New')}} <i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body">

                                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                    @foreach ($languages as $language)

                                    <li class="nav-item">
                                        <a class="nav-link {{$loop->index === 0 ? 'active' : ''}}" id="home-tab2" data-toggle="tab" href="#home-{{$language->lang}}" role="tab" aria-controls="home" aria-selected="true">{{$language->name}}</a>
                                      </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content tab-bordered" id="myTab3Content">
                                    @foreach ($languages as $language)


                                  <div class="tab-pane fade {{$loop->index === 0 ? 'show active' : ''}} " id="home-{{$language->lang}}" role="tabpanel" aria-labelledby="home-tab2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <button class="badge badge-primary mx-2">{{__('Generate String')}}</button>
                                                <button class="badge badge-dark mx-2">{{__('Translate String')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                   <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-{{$language->lang}}">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        #
                                                    </th>
                                                    <th>{{__('Name')}}</th>
                                                    <th>{{__('Laguage Code')}}</th>
                                                    <th>{{__('Show In Navbar')}}</th>
                                                    <th>{{__('status')}}</th>

                                                    <th>{{__('Action')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
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
        @foreach ($languages as $language)

        $("#table-{{$language->lang}}").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [2, 3]
            }]
        });
        @endforeach
    </script>
@endpush
