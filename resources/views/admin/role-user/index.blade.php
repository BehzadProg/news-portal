@extends('admin.layouts.master')
@section('title', __('admin_localize.Role Users'))
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin_localize.Role Users')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{__('admin_localize.All Role Users')}}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.role-users.create') }}" class="btn btn-primary">{{__('admin_localize.Create New')}} <i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>{{__('admin_localize.Name')}}</th>
                                            <th>{{__('admin_localize.Email')}}</th>
                                            <th>{{__('admin_localize.Role')}}</th>

                                            <th>{{__('admin_localize.Action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admins as $admin)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$admin->name}}</td>
                                            <td>{{$admin->email}}</td>
                                            <td><span class="badge badge-primary">{{$admin->getRoleNames()->first()}}</span></td>
                                            <td>
                                                @if ($admin->getRoleNames()->first() !== 'Super Admin')

                                                <a href="{{route('admin.role-users.edit' , $admin->id)}}" class="btn btn-primary mr-2"><i class="fas fa-edit"></i></a>
                                                <a href="{{route('admin.role-users.destroy' , $admin->id)}}" class="btn btn-danger delete-item"><i class="fas fa-trash-alt"></i></a>
                                                @endif
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
