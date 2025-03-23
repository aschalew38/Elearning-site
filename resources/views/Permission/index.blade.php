@extends('BackEnd.Layout.base')
@section('title', 'List of Permission')

@section('content')
    <form method='POST' id="deleteForm">@csrf @method('DELETE')</form>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title text-blue">List of Permissions</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="permission_table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($permissions) == 0)
                                        <tr>
                                            <td colspan="3" class="text-center">No record found</td>
                                        </tr>
                                    @endif
                                    @foreach ($permissions as $permission)
                                        <tr class="border border-b-1">
                                            <td>{{ $permission->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="px-5 py-2 d-flex justify-content-end">
                                @if (method_exists($permissions, 'links'))
                                    {{ $permissions->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
