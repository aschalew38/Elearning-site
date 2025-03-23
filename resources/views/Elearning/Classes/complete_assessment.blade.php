@extends('Elearning.Classes.base')
@section('title', 'Complete all assessment')
@section('content')
    <div class="alert alert-outline-danger col-md-6 mx-auto shadow-danger p-4 my-4 font-16" role="alert">
        <strong>!!</strong> To take this Exam you should have to complete all videos, exercises and Test
        <br>

        <div class="d-flex justify-content-end mt-4 mb-2">
            <a class="btn btn-primary" id="enrolll" href="{{ route('gotoclass', ['course' => $course]) }}">Go
                Back to class</a>
        </div>
    </div>
@endsection
