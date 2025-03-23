@extends('BackEnd.Layout.base')
@section('title', 'Events')
@push('css')
    <link rel="stylesheet" href="{{ asset('BackEnd/plugins/sweet-alert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('BackEnd/plugins/toastr/toastr.min.css') }}">
@endpush
@section('content')
    @php
        use App\Constants;
    @endphp
    @if (session()->has('success'))
        <div class="alert alert-outline-success alert-dismissible d-flex align-items-center col-md-8 mb-0" role="alert">
            <i class="ti ti-checks alert-icon me-2"></i>
            <div>
                <strong>{{ session('success') }}</strong>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form method='POST' id="deleteForm">@csrf @method('DELETE')</form>
    <div class="row mt-4">
        <div class="col-lg-11">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">List of events</h4>
                    @can('events.create')
                        <div class="">
                            <a class="btn btn-sm btn-primary px-3 shadow-inset" href="{{ route('event.create') }}"
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
                                    <th class="">Type</th>
                                    <th class="col-md-5">About</th>
                                    <th class="">Starting Date and Time</th>
                                    <th class="">Ending Date</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($events?->count() == 0)
                                    <tr>
                                        <td colspan="4" class="text-center">No records Found</td>
                                    </tr>
                                @else
                                    @foreach ($events as $nw)
                                        <td><img src="{{ asset('storage/' . $nw->poster) }}" alt=""
                                                class="rounded-circle thumb-xs me-1">
                                            <a href="{{ route('event.show', ['event' => $nw->id]) }}">
                                                <span class="mx-4">
                                                    {{ $nw->type }}

                                                </span></a>
                                        </td>
                                        <td class="col-md-6">
                                            <a href="{{ route('event.show', ['event' => $nw->id]) }}">
                                                <span class="mx-4">
                                                    {{ $nw->about }}

                                                </span></a>
                                        </td>
                                        <td class="">

                                            <p class=""> {{ $nw->starting_date }} at {{ $nw->starting_time }}
                                            </p>
                                        </td>
                                        <td class="">

                                            <p class=""> {{ $nw->ending_date }}
                                            </p>
                                        </td>

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="px-5 py-2 d-flex justify-content-end">
                            @if (method_exists($events, 'links'))
                                {{ $events->links() }}
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
