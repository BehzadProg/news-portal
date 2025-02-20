@extends('admin.layouts.master')
@section('title', __('admin_localize.Contact Messages'))
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin_localize.Contact Messages') }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('admin_localize.All Contact Messages') }}

                                 @if ($unReadMessages > 0)
                            <i class="badge badge-warning">{{$unReadMessages}}</i>
                            {{__('admin_localize.New')}}
                            @endif
                            </h4>
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
                                                <th>{{ __('admin_localize.Email') }}</th>
                                                <th>{{ __('admin_localize.Subject') }}</th>
                                                <th>{{ __('admin_localize.Message Summary') }}</th>
                                                <th>{{ __('admin_localize.Replied') }}</th>

                                                <th width="150px">{{ __('admin_localize.Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($messages as $message)
                                                <tr>
                                                    <td>{{ ++$loop->index }}</td>
                                                    <td>{{ $message->email }}</td>
                                                    <td>{{ $message->subject }}</td>
                                                    <td>{{ limitText($message->message, 140) }}</td>
                                                    <td>
                                                        @if ($message->replied == 1)
                                                        <i style="font-size: 20px" class="fas fa-check text-success"></i>
                                                        @else
                                                        <i style="font-size: 20px" class="fas fa-hourglass-half text-warning"></i>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <a href="" class="btn btn-primary mr-2 seen" data-id="{{ $message->id }}" data-toggle="modal"
                                                            data-target="#messageModal-{{ $message->id }}"><i class="fas fa-eye"></i></a>
                                                        <a href="" class="btn btn-primary mr-2" data-toggle="modal"
                                                            data-target="#exampleModal-{{ $message->id }}"><i class="fas fa-reply"></i></a>
                                                        <a href="{{route('admin.contact-message.destroy' , $message->id)}}" class="btn btn-danger delete-item"><i class="fas fa-trash-alt"></i></a>
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

    @foreach ($messages as $message)
        <!-- Modal -->
        <div class="modal fade" id="exampleModal-{{ $message->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('admin_localize.Replay to')}} : {{$message->email}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('admin.contact.send-reply')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">{{__('admin_localize.Subject')}}</label>
                                @error('subject')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                                <input type="text" name="subject" class="form-control">
                                <input type="hidden" name="email" value="{{$message->email}}">
                                <input type="hidden" name="message_id" value="{{$message->id}}">
                            </div>
                            <div class="form-group">
                                <label for="">{{__('admin_localize.Message')}}</label>
                                @error('reply')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                               <textarea name="reply" style="height: 250px !important" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('admin_localize.Close')}}</button>
                            <button class="btn btn-primary" type="submit">{{__('admin_localize.Send')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    @foreach ($messages as $message)
        <!-- Modal -->
        <div class="modal fade" id="messageModal-{{ $message->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('admin_localize.Full Message')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">{{__('admin_localize.Subject')}}</label>
                            <p class="border p-2 m-0" style="border-radius: 5px">{{ $message->subject }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">{{__('admin_localize.Message')}}</label>
                            <p class="border p-2 m-0" style="border-radius: 5px">{{ $message->message }}</p>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('admin_localize.Close')}}</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@push('scripts')
    <script>
        $("#table").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [2, 3]
            }]
        });

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                Toast.fire({
                    icon: 'error',
                    title: '{{ $error }}'
                });
            @endforeach
        @endif

        $(document).ready(function() {
            $('.seen').on('click', function() {
                let id = $(this).data('id')

                $.ajax({
                    method: 'PUT',
                    url: "{{ route('admin.contact.seen') }}",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.status === 'success') {
                            Toast.fire({
                                icon: "success",
                                title: data.message
                            });
                        }else if(data.status === 'info'){
                            Toast.fire({
                                icon: "info",
                                title: data.message
                            });
                        }
                    },
                    error: function(data) {

                    }
                })
            })
        })
    </script>
@endpush
