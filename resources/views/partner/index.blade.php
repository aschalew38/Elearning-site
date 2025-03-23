@extends('BackEnd.Layout.base')
@section('title', 'List of Partners')
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
        <div class="col-lg-11">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">List of Partners</h4>
                    @can('partner.create')
                        <div class="">

                            <a class="btn btn-sm btn-primary px-3 shadow-inset" href="{{ route('partner.create') }}"
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
                                    <th class="">Name</th>
                                    <th class="">Type</th>
                                    <th>Email</th>
                                    <th>phone</th>
                                    <th>Web address</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($partners?->count() == 0)
                                    <tr>
                                        <td colspan="4" class="text-center">No records Found</td>
                                    </tr>
                                @else
                                    @foreach ($partners as $partner)
                                        <td class="text-start">
                                            {{-- <span class="mx-4 text-start"> --}}

                                                {{ $partner->name }}
                                            {{-- </span> --}}
                                        </td>
                                        <td class="col-md-2">

                                            {{$partner->email}}
                                        </td>
                                        <td class="col-md-2">

                                            {{$partner->organization_type->name}}
                                        </td>
                                        <td class="col-md-2">

                                            {{$partner->phone}}
                                        </td>
                                            <td class="d-flex">

                                            <p class="badge rounded-pill bg-primary"> {{ $partner->url }}
                                            </p>
                                        </td>
                                        <td class="align-text-top">
                                            <a href="{{ route('partner.show', ['partner' => $partner->id]) }}">
                                                <i                                                         class="las la-eye text-primary font-16"></i>

                                            </a>
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
    @include("AdditionResource.create")
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
