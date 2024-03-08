@extends('admin.layouts.master')
@section('title', __('admin_localize.Footer Grid One'))
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin_localize.Footer Grid One') }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
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
                                        $footerTitle = \App\Models\FooterTitle::where(['language' => $language->lang , 'key' => 'grid_one_title'])
                                            ->first();
                                    @endphp

                                    <div class="tab-pane fade {{ $loop->index === 0 ? 'show active' : '' }} "
                                        id="home-{{ $language->lang }}" role="tabpanel" aria-labelledby="home-tab2">
                                        <div class="card-body">
                                            <form action="{{route('admin.footer-grid-one-title')}}" method="POST">
                                                @csrf
                                                <div class="form-group row mb-4">
                                                    <label
                                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('admin_localize.Footer Grid One Title') }}</label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <input name="title" type="text" value="{{@$footerTitle->value}}" class="form-control">
                                                        <input name="language" type="hidden" value="{{$language->lang}}" class="form-control">
                                                        @error('title')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-4">
                                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                                    <div class="col-sm-12 col-md-7">
                                                        <button class="btn btn-primary">{{__('admin_localize.Save')}}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('admin_localize.All Footer Grid One Links') }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.footer-grid-one.create') }}"
                                    class="btn btn-primary">{{ __('admin_localize.Create New') }} <i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body">

                            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                @foreach ($languages as $language)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $loop->index === 0 ? 'active' : '' }}" id="home-tab2"
                                            data-toggle="tab" href="#dtable-{{ $language->lang }}" role="tab"
                                            aria-controls="home" aria-selected="true">{{ $language->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content tab-bordered" id="myTab3Content">
                                @foreach ($languages as $language)
                                    @php
                                        $footers = \App\Models\FooterGridOne::where('language', $language->lang)
                                            ->orderByDesc('id')
                                            ->get();
                                    @endphp

                                    <div class="tab-pane fade {{ $loop->index === 0 ? 'show active' : '' }} "
                                        id="dtable-{{ $language->lang }}" role="tabpanel" aria-labelledby="home-tab2">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="table-{{ $language->lang }}">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">
                                                                #
                                                            </th>
                                                            <th>{{ __('admin_localize.Name') }}</th>
                                                            <th>{{ __('admin_localize.Laguage Code') }}</th>
                                                            <th>{{ __('admin_localize.Status') }}</th>

                                                            <th>{{ __('admin_localize.Action') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($footers as $footer)
                                                            <tr>
                                                                <td>{{ $loop->index + 1 }}</td>
                                                                <td>{{ $footer->name }}</td>
                                                                <td>{{ $footer->language }}</td>

                                                                <td>
                                                                    @if ($footer->status === 1)
                                                                        <span
                                                                            class="badge badge-success">{{ __('admin_localize.Active') }}</span>
                                                                    @else
                                                                        <span
                                                                            class="badge badge-danger">{{ __('admin_localize.InActive') }}</span>
                                                                    @endif

                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('admin.footer-grid-one.edit', $footer->id) }}"
                                                                        class="btn btn-primary mr-2"><i
                                                                            class="fas fa-edit"></i></a>
                                                                    <a href="{{ route('admin.footer-grid-one.destroy', $footer->id) }}"
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
    </script>
@endpush
