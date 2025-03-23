@extends('BackEnd.Layout.base')
@section('title', 'New Role')
@push('js')
    <script>
        function deleteEntry(route) {
            swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then(function(result) {
                if (result.value) {
                    $('#deleteForm').attr('action', route);
                    $('#deleteForm').submit();
                }
            });

        }
    </script>
@endpush
@section('content')
    <form method='POST' id="deleteForm">@csrf @method('DELETE')</form>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title text-blue">List of Roles</h3>
                                <a class="btn btn-primary btn-sm" href="{{ route('role.create') }}"><i
                                        class="fa fa-plus mr-2"></i> Add Role</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="role_table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($roles) == 0)
                                        <tr>
                                            <td colspan="3" class="text-center">No record found</td>
                                        </tr>
                                    @endif
                                    @foreach ($roles as $role)
                                        <tr class="border border-b-1">
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                <div class="flex flex-row .p-2">
                                                    <a href="{{ route('role.show', ['role' => $role->id]) }}"
                                                        class="mr-2">
                                                        <i class='fas fa-eye'></i>
                                                    </a>
                                                    @if (!in_array($role->name, \App\Constants::STATIC_ALL_ROLES))
                                                        <a href="{{ route('role.edit', ['role' => $role->id]) }}"
                                                            class="mr-2">
                                                            <i class='fas fa-edit'></i>
                                                        </a>
                                                        <a href="#"
                                                            onclick="event.preventDefault();deleteEntry('{{ route('role.destroy', ['role' => $role->id]) }}')"
                                                            class="mr-2 text-danger">
                                                            <i class='fas fa-trash'></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="px-5 py-2 d-flex justify-content-end">
                                @if (method_exists($roles, 'links'))
                                    {{ $roles->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
