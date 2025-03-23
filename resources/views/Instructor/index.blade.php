@extends('BackEnd.Layout.base')
@section('title', 'List of Trainners')
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
                    <h4 class="card-title">List of Instructors</h4>

                </div>
                <!--end card-header-->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>

                                    <th class="">Name</th>
                                    <th class="col-md-5">Phone</th>
                                    {{-- <th class="">Status</th> --}}
                                    <th class="">Email</th>
                                    <th class="">courses</th>
                                    {{-- <th class="text-end">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if ($trainners?->count() == 0)
                                    <tr>
                                        <td colspan="4" class="text-center">No records Found</td>
                                    </tr>
                                @else
                                    @foreach ($trainners as $trainner)
                                        <td class="col-md-6 text-left">
                                            <span class="mx-2">
                                                @if ($trainner?->profile)
                                                <img src="{{ asset('storage/' . $trainner?->profile) }}" class="thumb-xs me-1 rounded-circle"
                                                    {{-- height="50px" width="50px" alt="" --}}
                                                    >
                                            @else
                                                {{-- <img src="{{ asset('Front/assets/img/trainers/trainer-2.jpg') }}"
                                                                                    height="50px" width="50px" alt=""> --}}
                                                <i class="fa fa-user"></i>
                                            @endif
                                                {{-- <img src="{{ asset('storage/' . $trainner->profile) }}" alt="" --}}
                                                {{-- class="rounded-circle thumb-xs me-1"> --}}
                                            </span>
                                            <span class="">
                                                {{ $trainner->name }}

                                            </span>
                                        </td>
                                        <td>{{$trainner->phone}}</td>
                                        <td class="d-flex">
                                             {{ $trainner->email }}
                                        </td>
                                        <td class="px-1">
                                            @foreach($trainner->courses as $course)
                                                <span class="badge badge-primary bg-primary">{{$course->name}}</span>
                                            @endforeach
                                        </td>

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="px-5 py-2 d-flex justify-content-end">
                            @if (method_exists($trainners, 'links'))
                                {{ $trainners->links() }}
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
