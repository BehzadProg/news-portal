@extends('admin.layouts.master')
@section('title', '- Language')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('Language')}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{__('All Language')}}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.language.create') }}" class="btn btn-primary">{{__('Create New')}} <i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>{{__('Laguage Name')}}</th>
                                            <th>{{__('Laguage Code')}}</th>
                                            <th>{{__('Default')}}</th>
                                            <th>{{__('status')}}</th>

                                            <th>{{__('Action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($languages as $lang)

                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$lang->name}}</td>
                                            <td>{{$lang->lang}}</td>
                                            <td>
                                                @if ($lang->default === 1)
                                                <span class="badge badge-primary">{{__('Yes')}}</span>
                                                @else
                                                <span class="badge badge-warning">{{__('No')}}</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($lang->status === 1)
                                                <span class="badge badge-success">{{__('Active')}}</span>
                                                @else
                                                <span class="badge badge-danger">{{__('InActive')}}</span>
                                                @endif

                                            </td>
                                            <td>
                                                <a href="{{route('admin.language.edit' , $lang->id)}}" class="btn btn-primary mr-2"><i class="fas fa-edit"></i></a>
                                                <a href="{{route('admin.language.destroy' , $lang->id)}}" class="btn btn-danger delete-item"><i class="fas fa-trash-alt"></i></a>
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
        $("#table-1").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [2, 3]
            }]
        });
    </script>
@endpush
