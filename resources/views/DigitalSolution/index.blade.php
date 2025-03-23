@extends('BackEnd.Layout.base')
@section('title', 'Digital Solution')
@push('css')
    <link rel="stylesheet" href="{{ asset('BackEnd/plugins/sweet-alert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('BackEnd/plugins/toastr/toastr.min.css') }}">
@endpush

@section('content')

    @php
        use App\Constants;
    @endphp
    {{-- @if (session()->has('success'))
        <div class="alert alert-outline-success alert-dismissible d-flex align-items-center col-md-8 mb-0" role="alert">
            <i class="ti ti-checks alert-icon me-2"></i>
            <div>
                <strong>{{ session('success') }}</strong>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif --}}
    <form method='POST' id="deleteForm">@csrf @method('DELETE')</form>
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Digital Solutions</h4>
                    @can('digitalSolution.create')
                        <div class="">
                            <a class="btn btn-sm btn-primary px-3 shadow-inset" href="{{ route('digitalSolution.create') }}"
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
                                    <th class="text-center">Title</th>
                                    <th>Objective</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($digitalSolutions?->count() == 0)
                                    <tr>
                                        <td colspan="4" class="text-center">No records Found</td>
                                    </tr>
                                @else
                                    @foreach ($digitalSolutions as $digitalSolution)
                                        <td><img src="{{ asset('storage/' . $digitalSolution->poster) }}" alt=""
                                                class="rounded-circle thumb-xs me-1">
                                            <span class="mx-4">

                                                {{ $digitalSolution->title }}
                                            </span>
                                        </td>
                                        <td class="col-md-6">{{ $digitalSolution->objective }}</td>
                                        <td class="d-flex">

                                            <p class="badge rounded-pill bg-primary"> {{ $digitalSolution->status }}
                                            </p>
                                        </td>
                                        <td class="align-text-top">
                                            @canany(['digitalSolution.activate', 'digitalSolution.deactivate'])
                                                @if ($digitalSolution->status == 'Pending')
                                                    <a href="{{ route('digitalSolution.activate', ['digitalSolution' => $digitalSolution->id]) }}"
                                                        class="mx-2">&nbsp; &nbsp; activate</a>
                                                @elseif($digitalSolution->status == 'Active')
                                                    <a href="{{ route('digitalSolution.deactivate', ['digitalSolution' => $digitalSolution->id]) }}"
                                                        class="mx-2">Deactivate</a>
                                                @else
                                                    &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                                    &nbsp;&nbsp; &nbsp;
                                                @endif
                                            @endcanany
                                            @can('digitalSolution.show')
                                                <a
                                                    href="{{ route('digitalSolution.show', ['digitalSolution' => $digitalSolution->id]) }}"><i
                                                        class="las la-eye text-primary font-16"></i>
                                                </a>
                                            @endcan
                                            @if (auth()->user()->id == $digitalSolution->user_id ||
                                                    auth()->user()->hasAnyRole([Constants::SUPER_ADMIN_ROLE, Constants::ADMIN_ROLE]))
                                                @can('digitalSolution.edit')
                                                    <a
                                                        href="{{ route('digitalSolution.edit', ['digitalSolution' => $digitalSolution->id]) }}"><i
                                                            class="las la-pen text-secondary font-16"></i></a>
                                                @endcan
                                                @can('digitalSolution.destroy')
                                                    <a href="#"
                                                        onclick="event.preventDefault();
                                                 deleteForm('{{ route('digitalSolution.destroy', $digitalSolution->id) }}')">

                                                        <i class="las la-trash-alt text-danger font-16"></i></a>
                                                @endcan
                                            @endif
                                        </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
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
