@extends('admin.layouts.master')
@section('title', __('admin_localize.Social Count'))
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin_localize.Social Count')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{__('admin_localize.All Social Count')}}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.social-count.create') }}" class="btn btn-primary">{{__('admin_localize.Create New')}} <i
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
                                    @php
                                        $socialCounts = \App\Models\SocialCount::where('language' , $language->lang)->get()
                                    @endphp

                                  <div class="tab-pane fade {{$loop->index === 0 ? 'show active' : ''}} " id="home-{{$language->lang}}" role="tabpanel" aria-labelledby="home-tab2">
                                   <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-{{$language->lang}}">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        #
                                                    </th>
                                                    <th>{{__('admin_localize.Icon')}}</th>
                                                    <th>{{__('admin_localize.Link')}}</th>
                                                    <th>{{__('admin_localize.Status')}}</th>
                                                    <th>{{__('admin_localize.Language')}}</th>

                                                    <th>{{__('admin_localize.Action')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($socialCounts as $socialCount)
                                                <tr>
                                                    <td>{{++ $loop->index}}</td>
                                                    <td><i style="font-size: 20px;" class="{{$socialCount->icon}}"></i></td>
                                                    <td>{{$socialCount->url}}</td>

                                                    <td>
                                                        @if ($socialCount->status === 1)
                                                        <span class="badge badge-success">{{__('admin_localize.Active')}}</span>
                                                        @else
                                                        <span class="badge badge-danger">{{__('admin_localize.InActive')}}</span>
                                                        @endif

                                                    </td>
                                                    <td>{{$socialCount->language}}</td>

                                                    <td>
                                                        <a href="{{route('admin.social-count.edit' , $socialCount->id)}}" class="btn btn-primary mr-2"><i class="fas fa-edit"></i></a>
                                                        <a href="{{route('admin.social-count.destroy' , $socialCount->id)}}" class="btn btn-danger delete-item"><i class="fas fa-trash-alt"></i></a>
                                                    </td>

                                                </tr>

                                                @endforeach
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
