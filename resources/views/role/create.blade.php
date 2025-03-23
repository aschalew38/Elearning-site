@extends('BackEnd.Layout.base')
@section('title', 'Add Role')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <style>
        .select2,
        .select2-container,
        .select2-container--default,
        .select2-container--below {
            width: 100% !important;
        }

        .select2-selection,
        .select2-selection--single {
            height: auto !important;
            display: none;
        }
    </style>
@endpush
@push('js')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2()
        });
    </script>
@endpush
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Role</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('role.store') }}" class="row" method="POST">
                @csrf
                @include('role.form')
                <div class="text-right col-md-12">
                    <input type="submit" value="Add Role" class="btn btn-primary float-right">
                </div>
            </form>

        </div>
        <!-- /.card-body -->
    </div>
@endsection
