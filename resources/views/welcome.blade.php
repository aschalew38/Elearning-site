@extends('Front.Layout.base')
@section('title', 'Digital Solution')
@section('content')

    @include('Front.Layout.hero')
    <!-- ======= About Section ======= -->
    @include('Front.layout.popular_course')
    @include('Front.layout.blogs')
    @include('Front.Layout.about')
    @include('Front.layout.count')
    @include('Front.layout.feature')
    {{-- @include('Front.layout.why_us'); --}}
    @include('Front.layout.Trainers')
@endsection
