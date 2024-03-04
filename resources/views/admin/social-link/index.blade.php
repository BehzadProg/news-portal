@extends('admin.layouts.master')
@section('title', __('admin_localize.Social-links'))
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin_localize.Social Links') }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('admin_localize.All Social Links') }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.social-link.create') }}" class="btn btn-primary">{{ __('admin_localize.Create New') }} <i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="tab-content tab-bordered" id="myTab3Content">

                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            #
                                                        </th>
                                                        <th>{{__('admin_localize.Icon')}}</th>
                                                        <th>{{__('admin_localize.Link')}}</th>
                                                        <th>{{__('admin_localize.Status')}}</th>

                                                        <th width="150px">{{ __('admin_localize.Action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($socialLinks as $socialLink)
                                                    <tr>
                                                        <td>{{++ $loop->index}}</td>
                                                        <td><i style="font-size: 20px;" class="{{$socialLink->icon}}"></i></td>
                                                        <td>{{$socialLink->url}}</td>

                                                        <td>
                                                            @if ($socialLink->status === 1)
                                                            <span class="badge badge-success">{{__('admin_localize.Active')}}</span>
                                                            @else
                                                            <span class="badge badge-danger">{{__('admin_localize.InActive')}}</span>
                                                            @endif

                                                        </td>

                                                        <td>
                                                            <a href="{{route('admin.social-link.edit' , $socialLink->id)}}" class="btn btn-primary mr-2"><i class="fas fa-edit"></i></a>
                                                            <a href="{{route('admin.social-link.destroy' , $socialLink->id)}}" class="btn btn-danger delete-item"><i class="fas fa-trash-alt"></i></a>
                                                        </td>

                                                    </tr>

                                                    @endforeach
                                                </tbody>
                                            </table>
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
        $("#table").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [2, 3]
            }]
        });

    </script>
@endpush
