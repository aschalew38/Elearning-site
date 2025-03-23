@extends('BackEnd.Layout.base')

@section('title', 'Digital Solution')
@section('content')
    <form class="" action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('News.form')
    </form>

@endsection
@push('js')
    <script src="{{ asset('BackEnd/plugins/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('BackEnd/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/pages/jquery.forms-advanced.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/pages/jquery.form-repeater.js') }}"></script>
@endpush
