@extends('BackEnd.Layout.base')

@section('title', "Create blog")
@section('content')
    @if (session()->has('error'))
        <div class="alert col-md-6 mx-4 shadow-lg alert-outline-danger" role="alert">
            <strong> {{ session('error') }}</strong>
        </div>
    @endif
    <form class="col-md-10 mx-auto" action="{{ route('blogs.store') }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @include('Component.forms.blog-form')
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary btn-block px-4">Post</button>
        </div>
    </form>

@endsection
@push('js')
    <script src="{{ asset('BackEnd/plugins/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('BackEnd/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/pages/jquery.forms-advanced.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/pages/jquery.form-repeater.js') }}"></script>
@endpush
