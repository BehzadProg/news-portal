@extends('admin.layouts.master')
@section('title', __('- News'))
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('News') }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('All News') }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.news.create') }}" class="btn btn-primary">{{ __('Create New') }} <i
                                        class="fas fa-plus"></i></a>
                            </div>
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
                                    @php
                                        $news = \App\Models\News::with('category')
                                            ->where('language', $language->lang)
                                            ->orderByDesc('id')
                                            ->get();
                                    @endphp

                                    <div class="tab-pane fade {{ $loop->index === 0 ? 'show active' : '' }} "
                                        id="home-{{ $language->lang }}" role="tabpanel" aria-labelledby="home-tab2">

                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table-{{ $language->lang }}">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            #
                                                        </th>
                                                        <th>{{ __('Image') }}</th>
                                                        <th>{{ __('Title') }}</th>
                                                        <th>{{ __('Category') }}</th>
                                                        <th>{{ __('In Slider') }}</th>
                                                        <th>{{ __('In Breaking') }}</th>
                                                        <th>{{ __('In Popular') }}</th>
                                                        <th>{{ __('status') }}</th>

                                                        <th>{{ __('Action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($news as $item)
                                                        <tr>
                                                            <td>{{ $loop->index + 1 }}</td>
                                                            <td>
                                                                <img width="100" height="60"
                                                                    src="{{ asset(env('NEWS_IMAGE_UPLOAD_PATH') . $item->image) }}"
                                                                    alt="">
                                                            </td>
                                                            <td>{{ $item->title }}</td>
                                                            <td>{{ $item->category->name }}</td>
                                                            <td>
                                                                <label class="custom-switch mt-2">
                                                                    <input
                                                                        {{ $item->show_at_slider === 1 ? 'checked' : '' }}
                                                                        type="checkbox" data-id="{{ $item->id }}"
                                                                        data-name="show_at_slider"
                                                                        class="custom-switch-input toggle-status">
                                                                    <span class="custom-switch-indicator"></span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="custom-switch mt-2">
                                                                    <input
                                                                        {{ $item->is_breaking_news === 1 ? 'checked' : '' }}
                                                                        type="checkbox" data-id="{{ $item->id }}"
                                                                        data-name="is_breaking_news"
                                                                        class="custom-switch-input toggle-status">
                                                                    <span class="custom-switch-indicator"></span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="custom-switch mt-2">
                                                                    <input
                                                                        {{ $item->show_at_popular === 1 ? 'checked' : '' }}
                                                                        type="checkbox" data-id="{{ $item->id }}"
                                                                        data-name="show_at_popular"
                                                                        class="custom-switch-input toggle-status">
                                                                    <span class="custom-switch-indicator"></span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="custom-switch mt-2">
                                                                    <input {{ $item->status === 1 ? 'checked' : '' }}
                                                                        type="checkbox" data-id="{{ $item->id }}"
                                                                        data-name="status"
                                                                        class="custom-switch-input toggle-status">
                                                                    <span class="custom-switch-indicator"></span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('admin.news.edit', $item->id) }}"
                                                                    class="btn btn-primary mr-2"><i
                                                                        class="fas fa-edit"></i></a>
                                                                <a href="{{ route('admin.news.destroy', $item->id) }}"
                                                                    class="btn btn-danger delete-item"><i
                                                                        class="fas fa-trash-alt"></i></a>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
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

            $("#table-{{ $language->lang }}").dataTable({
                "columnDefs": [{
                    "sortable": false,
                    "targets": [2, 3]
                }]
            });
        @endforeach

        $(document).ready(function() {
            $('.toggle-status').on('click', function() {
                let id = $(this).data('id')
                let name = $(this).data('name')
                let status = $(this).prop('checked') ? 1 : 0;

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.toggle-news-status') }}",
                    data: {
                        id: id,
                        name: name,
                        status: status
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            Toast.fire({
                                icon: "success",
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
