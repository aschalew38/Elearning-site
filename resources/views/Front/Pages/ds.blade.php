@extends('Front.Layout.base')
@section('title', 'Digital Solutions')
@section('content')

    <div style="padding-left: 10px" class="col-md-12 row min-vh-100 d-flex flex-row">
        @include('Front.Layout.ds')
        <div class="card col col-md-2 h-25 p-2">
            <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active">
                        Sectors
                    </a>
                @foreach ($catagories as $catagory)
                    <a href="{{ route('ds.search', ['sector' => $catagory->sector]) }}"
                        class="list-group-item list-group-item-action">{{ $catagory->sector }}</a>
                @endforeach
            </div>
        </div>
    </div>

@endsection
