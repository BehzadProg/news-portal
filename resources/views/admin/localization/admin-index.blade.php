@extends('admin.layouts.master')
@section('title', __('admin_localize.Localization'))
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin_localize.Admin Localization') }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('admin_localize.All Strings') }}</h4>
                        </div>
                        <div class="card-body">

                            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                @foreach ($languages as $language)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $loop->index === 0 ? 'active' : '' }}" id="home-tab2"
                                            data-toggle="tab" href="#home-{{ $language->lang }}" role="tab"
                                            aria-controls="home" aria-selected="true">{{ $language->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content tab-bordered" id="myTab3Content">
                                @foreach ($languages as $language)
                                    <div class="tab-pane fade {{ $loop->index === 0 ? 'show active' : '' }} "
                                        id="home-{{ $language->lang }}" role="tabpanel" aria-labelledby="home-tab2">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <form action="{{ route('admin.extract-localization-string') }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="directory"
                                                            value="{{ resource_path('views/admin') }},{{ app_path('Http/Controllers/Admin') }}">
                                                        <input type="hidden" name="language_code"
                                                            value="{{ $language->lang }}">
                                                        <input type="hidden" name="file_name" value="admin_localize">
                                                        <button type="submit"
                                                            class="btn btn-primary mx-2">{{ __('admin_localize.Generate String') }}</button>
                                                    </form>

                                                    <form class="translate-form">
                                                        <input type="hidden" name="language_code"
                                                            value="{{ $language->lang }}">
                                                        <input type="hidden" name="file_name" value="admin_localize">
                                                        <button type="submit"
                                                            class="btn btn-dark mx-2 translate_button">{{ __('admin_localize.Translate String') }}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="table-{{ $language->lang }}">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">
                                                                #
                                                            </th>
                                                            <th>{{ __('admin_localize.Strings') }}</th>
                                                            <th>{{ __('admin_localize.Translation') }}</th>
                                                            <th>{{ __('admin_localize.Action') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $localizedValues = trans(
                                                                'admin_localize',
                                                                [],
                                                                $language->lang,
                                                            );
                                                        @endphp

                                                        @if (is_array($localizedValues))
                                                            @foreach ($localizedValues as $key => $value)
                                                                <tr>
                                                                    <td>{{ ++$loop->index }}</td>
                                                                    <td>{{ $key }}</td>
                                                                    <td>{{ $value }}</td>
                                                                    <td>
                                                                        <button type="modal"
                                                                            class="btn btn-primary modal_lang"
                                                                            data-toggle="modal" data-target="#exampleModal"
                                                                            data-key="{{ $key }}"
                                                                            data-value="{{ $value }}"
                                                                            data-filename="admin_localize"
                                                                            data-lang="{{ $language->lang }}"><i
                                                                                class="fas fa-edit"></i></button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('admin_localize.Translation') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.translate-string.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ __('admin_localize.Strings') }}</label>
                            <input type="text" name="value" class="form-control" >
                            <input type="hidden" name="key">
                            <input type="hidden" name="lang">
                            <input type="hidden" name="file_name">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin_localize.Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('admin_localize.Save changes') }}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        @foreach ($languages as $language)

            $("#table-{{ $language->lang }}").dataTable({
                "columnDefs": [{
                    "sortable": false,
                }]
            });
        @endforeach

        $(document).ready(function() {
            $(document).on('click', '.modal_lang', function() {
                let lang = $(this).data('lang');
                let key = $(this).data('key');
                let value = $(this).data('value');
                let filename = $(this).data('filename');

                $('input[name="lang"]').val(lang);
                $('input[name="key"]').val(key);
                $('input[name="value"]').val(value);
                $('input[name="file_name"]').val(filename);
            });

            $('.translate-form').on('submit', function(e) {
                e.preventDefault();
                let formDate = $(this).serialize();

                $.ajax({
                    method: 'POST',
                    url: "{{ route('admin.translate-string-api') }}",
                    data: formDate,
                    beforeSend: function() {
                        $('.translate_button').text('Translating Please Wait...')
                        $('.translate_button').prop('disabled', true)
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            Swal.fire(
                                'Done!',
                                data.message,
                                'success'
                            )
                            window.location.reload();
                        } else {
                            Swal.fire(
                                'Error!',
                                data.message,
                                'error'
                            )
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            })
        })
    </script>
@endpush
