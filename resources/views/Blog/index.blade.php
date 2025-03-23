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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">List of blogs</h4>
                    @can('blogs.create')
                        <div class="">

                            <a class="btn btn-sm btn-primary px-3 shadow-inset" href="{{ route('blogs.create') }}"
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
                                    <th class="">title</th>
                                    <th>Overview</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($blogs?->count() == 0)
                                    <tr>
                                        <td colspan="4" class="text-center">No records Found</td>
                                    </tr>
                                @else
                                    @foreach ($blogs as $blog)
                                        <td class="text-start">
                                            {{-- <span class="mx-4 text-start"> --}}

                                                {{ $blog->title }}
                                            {{-- </span> --}}
                                        </td>
                                        <td class="col-md-8">

                                            {{$blog->overview}}

                                            <td class="d-flex">

                                            <p class="badge rounded-pill bg-primary"> {{ $blog->status }}
                                            </p>
                                        </td>
                                        <td class="align-text-top">
                                            @canany(['blog.activate', 'blog.deactivate'])
                                                @if ($blog->status == 'Pending')
                                                    <a href="{{ route('blog.activate', ['blog' => $blog->id]) }}"
                                                        class="mx-2">&nbsp; &nbsp; activate</a>
                                                @elseif($blog->status == 'Active')
                                                    <a href="{{ route('blog.deactivate', ['blog' => $blog->id]) }}"
                                                        class="mx-2">Deactivate</a>
                                                @else
                                                    &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                                    &nbsp;&nbsp; &nbsp;
                                                @endif
                                            @endcanany
                                            @can('blogs.show')
                                                <a
                                                    href="{{ route('blogs.show', ['blog' => $blog->id]) }}"><i
                                                        class="las la-eye text-primary font-16"></i>
                                                </a>
                                            @endcan
                                            @if (auth()->user()->id == $blog->user_id ||
                                                    auth()->user()->hasAnyRole([Constants::SUPER_ADMIN_ROLE, Constants::ADMIN_ROLE]))
                                                @can('blogs.edit')
                                                    <a
                                                        href="{{ route('blogs.edit', ['blog' => $blog->id]) }}"><i
                                                            class="las la-pen text-secondary font-16"></i></a>
                                                @endcan
                                                @can('blog.destroy')
                                                    <a href="#"
                                                        onclick="event.preventDefault();
                                                 deleteForm('{{ route('blogs.destroy', $blog->id) }}')">

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
