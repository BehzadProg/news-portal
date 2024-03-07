@extends('admin.layouts.master')
@section('title', __('admin_localize.Subscriber'))
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin_localize.Subscriber') }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('admin_localize.Send Mail to Subscribers') }}</h4>
                        </div>
                        <div class="card-body">


                            <div class="tab-content tab-bordered" id="myTab3Content">
                                <div class="card-body">
                                    <form action="{{route('admin.newsletter-send-mail')}}" method="POST">
                                        @csrf
                                        <div class="form-group row mb-4">
                                            <label
                                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('admin_localize.Subject') }}</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input name="subject" type="text" class="form-control">
                                                @error('subject')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label
                                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('admin_localize.Message') }}</label>
                                            <div class="col-sm-12 col-md-7">
                                                <textarea name="message" class="form-control summernote"></textarea>
                                                @error('message')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                            <div class="col-sm-12 col-md-7">
                                                <button class="btn btn-primary">{{__('admin_localize.Send')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('admin_localize.All Subscribers') }}</h4>
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
                                                <th>{{ __('admin_localize.Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subs as $sub)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $sub->email }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.subscriber.destroy', $sub->id) }}"
                                                            class="btn btn-danger delete-item"><i
                                                                class="fas fa-trash-alt"></i></a>
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
