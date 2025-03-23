@extends('BackEnd.Layout.base')
@section('title', 'News')
@push('css')
    <link rel="stylesheet" href="{{ asset('BackEnd/plugins/sweet-alert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('BackEnd/plugins/toastr/toastr.min.css') }}">
@endpush
@section('content')
    @php
        use App\Constants;
    @endphp
    {{-- @if (session()->has('success'))
        <div class="px-4 alert alert-outline-success alert-dismissible d-flex align-items-center col-md-8 mb-0" role="alert">
            <i class="ti ti-checks alert-icon me-2"></i>
            <div>
                <strong>{{ session('success') }}</strong>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif --}}
    <form method='POST' id="deleteForm">@csrf @method('DELETE')</form>
    <div class="row mt-4">
        <div class="col-lg-11">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">List of News</h4>
                    @can('news.create')
                        <div class="">
                            <a class="btn btn-sm btn-primary px-3 shadow-inset" href="{{ route('news.create') }}"
                                role="button"><i class="fas fa-plus me-2"></i>New</a>
                        </div>
                    @endcan
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th class="">Title</th>
                                    <th class="col-md-5">Headline</th>
                                    <th class="">Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($news?->count() == 0)
                                    <tr>
                                        <td colspan="4" class="text-center">No records Found</td>
                                    </tr>
                                @else
                                    @foreach ($news as $nw)
                                        <td><img src="{{ asset('storage/' . $nw->poster) }}" alt=""
                                                class="rounded-circle thumb-xs me-1">
                                            <a href="{{ route('news.show', ['news' => $nw->id]) }}">
                                                <span class="mx-4">
                                                    {{ $nw->title }}

                                                </span></a>
                                        </td>
                                        <td class="col-md-6">
                                            <a href="{{ route('news.show', ['news' => $nw->id]) }}">
                                                <span class="mx-4">
                                                    {{ $nw->headline }}

                                                </span></a>
                                        </td>
                                        <td class="d-flex">

                                            <p class="badge rounded-pill bg-primary"> {{ $nw->status }}
                                            </p>
                                        </td>
                                        <td class="align-text-top">
                                            @if ($nw->status == 'Active')
                                                @canany(['news.edit'])
                                                    <a href="{{ route('news.deactivate', ['news' => $nw->id]) }}"
                                                        class="mx-2">&nbsp; &nbsp; Remove</a>
                                                @endcanany

                                                @can('news.show')
                                                    <a href="{{ route('news.show', ['news' => $nw->id]) }}"><i
                                                            class="las la-eye text-primary font-16"></i>
                                                    </a>
                                                @endcan
                                                @if (auth()->user()->id == $nw->posted_by ||
                                                        auth()->user()->hasAnyRole([Constants::SUPER_ADMIN_ROLE, Constants::ADMIN_ROLE]))
                                                    @can('nw.edit')
                                                        <a href="{{ route('news.edit', ['news' => $nw->id]) }}"><i
                                                                class="las la-pen text-secondary font-16"></i></a>
                                                    @endcan
                                                    @can('news.destroy')
                                                        <a href="#"
                                                            onclick="event.preventDefault();
                                                 deleteForm('{{ route('news.destroy', $nw->id) }}')">

                                                            <i class="las la-trash-alt text-danger font-16"></i></a>
                                                    @endcan
                                                @endif
                                            @else
                                                &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                                &nbsp;&nbsp; &nbsp;
                                            @endif
                                        </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="px-5 py-2 d-flex justify-content-end">
                            @if (method_exists($news, 'links'))
                                {{ $news->links() }}
                            @endif
                        </div>
                        <!--end /table-->
                    </div>
                    <!--end /tableresponsive-->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div> <!-- end col -->

        <!-- end col -->
    </div>
@endsection
@push('js')
    <script src="{{ asset('BackEnd/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('BackEnd/plugins/toastr/toastr.min.js') }}"></script>
    <script>
        function deleteForm(route) {
            swal.fire({
                title: "Are you sure?",
                text: "Are Sure delete!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then(function(result) {
                if (result.value) {
                    $('#deleteForm').attr('action', route);
                    $('#deleteForm').submit();
                }
            });

        }
    </script>
@endpush
