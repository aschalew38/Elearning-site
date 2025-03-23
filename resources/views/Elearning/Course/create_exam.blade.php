@extends('BackEnd.Layout.base')

@section('title', $course->name)
@section('content')
    @if (session()->has('error'))
        <div class="alert col-md-6 mx-4 shadow-lg alert-outline-danger" role="alert">
            <strong> {{ session('error') }}</strong>
        </div>
    @endif
    <form class="" action="{{ route('store_exam', ['course' => $course->id]) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="row mt-2">
            <div class="col-lg-12 px-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Adding Exam questions for {{ $course->name }}</h4>
                    </div>
                    <!--end card-header-->
                    <div class="card-body">
                        <div class="col-sm-8">
                            <label class="form-label">Title</label>
                            <input type="text" name="name" required class="form-control">
                        </div>
                        @include('Elearning.Course.Resource.tf_form')
                        @include('Elearning.Course.Resource.bs_form')
                        <hr class="dashed">
                        <hr class="dashed">
                        @include('Elearning.Course.Resource.multiple_choice_form')
                    </div>

                    <div class="d-flex justify-content-end mb-4 mx-4">

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>

        </div> <!-- end col -->

        </div>

    </form>

@endsection
@push('js')
    <script src="{{ asset('BackEnd/plugins/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('BackEnd/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/pages/jquery.forms-advanced.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/pages/jquery.form-repeater.js') }}"></script>
@endpush
