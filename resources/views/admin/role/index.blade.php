@extends('admin.layouts.master')
@section('title', __('admin_localize.Role And Permission'))
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin_localize.Role And Permission')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{__('admin_localize.All Role And Permission')}}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.role.create') }}" class="btn btn-primary">{{__('admin_localize.Create New')}} <i
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
                                            <th>{{__('admin_localize.Role Name')}}</th>
                                            <th>{{__('admin_localize.Permissions')}}</th>

                                            <th>{{__('admin_localize.Action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$role->name}}</td>
                                            <td>
                                                @foreach ($role->permissions as $permission)
                                                <span class="badge badge-primary">{{$permission->name}}</span>
                                                @endforeach
                                                @if ($role->name == 'Super Admin')
                                                <span class="badge badge-success">{{__('admin_localize.All Permissions')}} *</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($role->name !== 'Super Admin')
                                                <a href="{{route('admin.role.edit' , $role->id)}}" class="btn btn-primary mr-2"><i class="fas fa-edit"></i></a>
                                                <a href="{{route('admin.role.destroy' , $role->id)}}" class="btn btn-danger delete-item"><i class="fas fa-trash-alt"></i></a>
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
