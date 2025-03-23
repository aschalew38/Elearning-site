@extends('BackEnd.Layout.base')
@section('title', 'List Of Courses')
@section('content')
    @php
        use App\Constants;

    @endphp
    {{-- @if (session()->has('success'))
        <div class="alert alert-outline-success alert-dismissible d-flex align-items-center col-md-10 mb-0" role="alert">
            <i class="ti ti-checks alert-icon me-2"></i>
            <div>
                <strong>{{ session('success') }}</strong>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif --}}
    <div class="row mt-4">
        <div class="col-sm-12 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">List Of Courses</h4>
                    @can('course.create')
                        <div class="">
                            <a class="btn btn-sm btn-primary px-3 shadow-inset" href="{{ route('course.create') }}"
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
                                    {{-- <th>Rating</th> --}}
                                    <th>Catagory</th>
                                    <th class="col-md-5">Overview</th>
                                    <th>status</th>
                                    <th class="text-center col-sm-3 col-md-3 col-lg-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($courses?->count() == 0)
                                    <tr>
                                        <td colspan="4" class="text-center">No records Found</td>
                                    </tr>
                                @else
                                    @foreach ($courses as $course)
                                        <td><img src="{{ asset('storage/' . $course->poster) }}" alt=""
                                                class="rounded-circle thumb-xs me-1">
                                            <span class="mx-1">

                                                {{ $course->name }}
                                            </span>
                                        </td>
                                        <td class="col-md-1 mx-1">{{ $course->catagory }}</td>
                                        @php
                                            $ov = implode(' ', array_slice(explode(' ', $course->overview), 0, 100));
                                        @endphp
                                        {{-- @dd($ov); --}}
                                        <td class="col-md-4">{{ $ov }} ..</td>
                                        <td class="d-flex">

                                            <p class="badge rounded-pill bg-primary"> {{ $course->status }}
                                            </p>
                                        </td>
                                        <td class="align-text-top">

                                            @can('course.activate')
                                                @if ($course->status == 'Pending')
                                                    <a href="{{ route('course.activate', ['course' => $course->id]) }}"
                                                        class="mx-2">&nbsp; &nbsp; activate</a>
                                                @elseif($course->status == 'Active')
                                                    <a href="{{ route('course.deactivate', ['course' => $course->id]) }}"
                                                        class="mx-2">Deactivate</a>
                                                @else
                                                    &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                                    &nbsp;&nbsp; &nbsp;
                                                @endif
                                            @endcan
                                            @can('course.show')
                                                <a href="{{ route('course.show', ['course' => $course->id]) }}"><i
                                                        class="las la-eye text-primary font-16"></i></a>
                                            @endcan
                                            @can('course.edit')
                                                <a href="{{ route('course.edit', ['course' => $course->id]) }}"><i
                                                        class="las la-pen text-secondary font-16"></i></a>
                                            @endcan
                                            @if (
                                                !$course->enrolled() &&
                                                    $course->Instructor_id != auth()->user()->id &&
                                                    !auth()->user()->hasRole(Constants::SUPER_ADMIN_ROLE))
                                                <a class="btn btn-link" id="enrolll"
                                                    href="{{ route('enroll', ['course' => $course]) }}">Enroll</a>
                                            @elseif(
                                                $course->Instructor_id != auth()->user()->id &&
                                                    !auth()->user()->hasRole(Constants::SUPER_ADMIN_ROLE))
                                                <a class="btn btn-link" id="enrolll"
                                                href="{{ route('course_certificate', ['course' => $course]) }}">
                                                <i class="fas fas fa-file-pdf"></i>
                                                </a>
                                                <a class="btn btn-link" id="enrolll"
                                                  title="Goto Class"
                                                    href="{{ route('gotoclass', ['course' => $course]) }}">
                                                    <i class="fas fa-solid fa-screen-users"></i>
                                                    Class</a>
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
    @endsection
