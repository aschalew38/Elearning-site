@extends('BackEnd.Layout.base')

@section('title', $course->name)
@section('content')
    @push('css')
        <link href="{{ asset('BackEnd/plugins/leaflet/leaflet.css') }}" rel="stylesheet">
        <link href="{{ asset('Backend/plugins/lightpick/lightpick.css') }}" rel="stylesheet" />
        <link href="{{ asset('BackEnd/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Plugins css -->
        <link href="{{ asset('Backend/plugins/huebee/huebee.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('Backend/plugins/timepicker/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
        <link href="{{ asset('Backend/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}"
            rel="stylesheet" />

        <!-- App css -->
        <link href="{{ asset('BackEnd/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('BackEnd/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    @endpush
    <div class="container-fluid">
        <!-- Page-Title -->

        <!--end row-->
        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dastone-profile">
                            <div class="row">
                                <div class="col-lg-4 align-self-center mb-lg-0">
                                    <div class="dastone-profile-main">
                                        <div class="dastone-profile-main-pic">
                                            <img src="{{ asset('storage/' . $course->poster) }}" alt=""
                                                height="50" width="50" class="rounded-circle">
                                        </div>
                                        <div class="dastone-profile_user-detail">
                                            <h5 class="dastone-user-name">{{ $course->name }}</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 ms-auto align-self-center">
                                    <ul class="list-unstyled personal-detail mb-0">
                                        <li class="">
                                            <b>
                                                Catagory </b> : {{ $course->catagory }}
                                        </li>
                                        <li class="">
                                            <b>
                                                Instructor </b> : {{ $course?->owner()?->name }}
                                        </li>

                                        <li class="mt-2"> <b>
                                                Total Hr:
                                            </b> {{ date('H:i', mktime(0, $course->minutes)) }} hours</li>

                                    </ul>

                                </div>
                                <!--end col-->
                                <div class="col-lg-4 align-self-center">
                                    <div class="row">
                                        <div class="col-auto text-end border-end">
                                            <h4 class="m-0 fw-bold">{{ $course->enrolled_students()?->count() }} <span
                                                    class="text-muted font-12 fw-normal">Students</span></h4>
                                        </div>
                                        <!--end col-->
                                        <div class="col-auto d-flex">

                                            <h4 class="m-0 fw-bold">{{$course->likes()}}<span
                                                    class="text-muted font-12 fw-normal">Likes</span></h4>

                                                    @if(!$course->liked())
                                                    <a  title="like this course"  href="{{route('course.like',["course"=>$course->id])}}" class="border-0 mx-4"><i class="fas fa-thin fa-thumbs-up"></i></a>
                                                    @else
                                                    <a  title="dislike this course" href="{{route('course.dislike',["course"=>$course->id])}}" class="border-0 mx-4"><i class="fas fa-thin fa-thumbs-down"></i></a>

                                                {{-- <button class="border-0 mx-4 bg-white" onclick="like(0)"><i class="fas fa-sharp fa-thin fa-thumbs-down mx-2"></i>Dislike</button> --}}
                                                @endif

                                        </div>
                                        <div>
                                            <h4 class="m-0 fw-bold">{{$course->active}}<span
                                                class="text-muted font-12 fw-normal mx-2">Active </span></h4>
                                        </div>
                                        <div>
                                            <h4 class="m-0 fw-bold">{{$course->CertifiedStudents}}<span
                                                class="text-muted font-12 fw-normal mx-2">Completed </span></h4>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end f_profile-->
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
        <div class="pb-4">
            <ul class="nav-border nav nav-pills mb-0" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="Syllabus_tab" data-bs-toggle="pill"
                        href="pages-profile.html#Syllabus">Syllabus</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="resource_tab" data-bs-toggle="pill"
                        href="pages-profile.html#resource">Resource</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="exercise_tab" data-bs-toggle="pill"
                        href="pages-profile.html#exercise">Exercise</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="reviews_tab" data-bs-toggle="pill" href="pages-profile.html#reviews">Reviews</a>
                </li>
                {{-- <li> --}}

                    {{-- </li> --}}
                @if (!$course->enrolled() && $course->Instructor_id != auth()->user()->id && $course->Sections?->count()>0)
                    <li class="nav-item">
                        <a class="btn btn-primary" id="enrolll"
                            href="{{ route('enroll', ['course' => $course]) }}">Enroll</a>
                    </li>
                @elseif($course->Instructor_id != auth()->user()->id && $course->Sections?->count()>0)
                    <li class="nav-item">
                        <a class="btn btn-primary" id="enrolll" href="{{ route('gotoclass', ['course' => $course]) }}">Go
                            To
                            Class</a>
                    </li>

                @endif

            </ul>
        </div>

        {{-- @if (session()->has('success'))
            <div class="alert alert-outline-success alert-dismissible d-flex align-items-center col-md-8 mb-0"
                role="alert">
                <i class="ti ti-checks alert-icon me-2"></i>
                <div>
                    <strong>{{ session('success') }}</strong>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif --}}
        <div class="row">
            <div class="col-12">
                <div class="tab-content" id="pills-tabContent">
                    @include('Elearning.Syllabus')
                    @include('Elearning.Exercise')
                    @include('Elearning.Resource')
                    @include('Elearning.Reviews')
                    {{-- @include('Patient.labratory') --}}
                    {{-- @include('Patient.payment') --}}
                    <!--end tab-pane-->
                </div>
                <!--end tab-content-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div>
    @push('js')
        <script src="{{ asset('BackEnd/plugins/leaflet/leaflet.js') }}"></script>
        <script src="{{ asset('BackEnd/plugins/lightpick/lightpick.js') }}"></script>
        <script src="{{ asset('BackEnd/assets/pages/jquery.profile.init.js') }}"></script>
        <script src="{{ asset('BackEnd/plugins/select2/select2.min.js') }}"></script>

        <script src="{{ asset('BackEnd/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('BackEnd/assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('BackEnd/assets/js/metismenu.min.js') }}"></script>
        <script src="{{ asset('BackEnd/assets/js/waves.js') }}"></script>
        <script src="{{ asset('BackEnd/assets/js/feather.min.js') }}"></script>
        <script src="{{ asset('BackEnd/assets/js/simplebar.min.js') }}"></script>
        <script src="{{ asset('BackEnd/assets/js/moment.js') }}"></script>

        <!-- Plugins js -->

        <script src="{{ asset('BackEnd/plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('BackEnd/plugins/huebee/huebee.pkgd.min.js') }}"></script>
        <script src="{{ asset('BackEnd/plugins/timepicker/bootstrap-material-datetimepicker.js') }}"></script>
        <script src="{{ asset('BackEnd/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
        <script src="{{ asset('BackEnd/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}"></script>

        <script src="{{ asset('BackEnd/assets/pages/jquery.forms-advanced.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('BackEnd/assets/js/app.js') }}"></script>
    @endpush
@endsection
