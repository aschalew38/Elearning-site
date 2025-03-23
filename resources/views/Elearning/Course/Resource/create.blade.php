@extends('BackEnd.Layout.base')

@section('title', $resource->title)
@section('content')
    @if (session()->has('error'))
        <div class="alert col-md-6 mx-4 shadow-lg alert-outline-danger" role="alert">
            <strong> {{ session('error') }}</strong>
        </div>
    @endif
    <form class="" action="{{ route('assessment.store', ['resource' => $resource->id]) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @include('Elearning.Course.Resource.form')
    </form>

@endsection
@push('js')
    <script src="{{ asset('BackEnd/plugins/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('BackEnd/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/pages/jquery.forms-advanced.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/pages/jquery.form-repeater.js') }}"></script>
@endpush
