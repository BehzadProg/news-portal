@extends('admin.layouts.master')
@section('title', __('admin_localize.Pending News'))
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin_localize.Pending News') }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('admin_localize.All Pending News') }}</h4>
                        </div>
                        <div class="card-body">
                            @php
                            if(canAccess(['news all-access'])){
                                $news = \App\Models\News::with('category')
                                ->where('is_approved' , 0)
                                ->orderByDesc('id')
                                ->get();
                            }else{
                                $news = \App\Models\News::with('category')
                                ->where('is_approved' , 0)
                                ->where('author_id' , Auth::guard('admin')->user()->id)
                                ->orderByDesc('id')
                                ->get();
                            }
                            @endphp
                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>{{ __('admin_localize.Image') }}</th>
                                            <th>{{ __('admin_localize.Title') }}</th>
                                            <th>{{ __('admin_localize.Category') }}</th>
                                            <th>{{ __('admin_localize.Approval Status') }}</th>
                                            <th width="130.217px">{{ __('admin_localize.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($news as $item)
                                            <tr>
                                                <td>{{ ++$loop->index }}</td>
                                                <td>
                                                    <img width="100" height="60"
                                                        src="{{ asset(env('NEWS_IMAGE_UPLOAD_PATH') . $item->image) }}"
                                                        alt="">
                                                </td>
                                                <td>{{ limitText($item->title) }}</td>
                                                <td>{{ $item->category->name }}</td>
                                                <td>
                                                @if(canAccess(['news all-access']))
                                                  <form action="" id="approve_form">
                                                    <input type="hidden" name="id" value="{{$item->id}}">
                                                    <div class="form-group">
                                                        <select name="is_approved" class="form-control" id="">
                                                            <option {{$item->is_approved == 0 ? 'selected' : ''}} value="0">{{__('admin_localize.Pending')}}</option>
                                                            <option value="1">{{__('admin_localize.Approve')}}</option>
                                                        </select>
                                                    </div>
                                                  </form>
                                                  @else

                                                  @if ($item->is_approved == 1)

                                                  <i style="font-size: 20px" class="fas fa-check text-success"></i>
                                                  @else
                                                  <i style="font-size: 20px" class="fas fa-hourglass-half text-warning"></i>
                                                  @endif
                                                @endif
                                                </td>
                                                <td>
                                                    @if (canAccess(['news update']))
                                                        <a href="{{ route('admin.news.edit', $item->id) }}"
                                                            class="btn btn-primary"><i
                                                                class="fas fa-edit"></i></a>
                                                    @endif
                                                    @if (canAccess(['news delete']))
                                                        <a href="{{ route('admin.news.destroy', $item->id) }}"
                                                            class="btn btn-danger delete-item"><i
                                                                class="fas fa-trash-alt"></i></a>
                                                    @endif
                                                    @if (canAccess(['news copy']))
                                                        <a href="{{ route('admin.copy-news', ['from_id' => $item->id]) }}"
                                                            class="btn btn-warning mr-2"><i
                                                                class="fas fa-copy"></i></a>
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


        $(document).ready(function() {
            $('#approve_form').on('change', function() {
                let data = $(this).serialize()

                $.ajax({
                    method: 'PUT',
                    url: "{{ route('admin.approve-news') }}",
                    data: data,
                    success: function(data) {
                        if (data.status === 'success') {
                            Toast.fire({
                                icon: "success",
                                title: data.message
                            });
                            window.location.reload();
                        }
                    },
                    error: function(data) {

                    }
                })
            })
        })
    </script>
@endpush
