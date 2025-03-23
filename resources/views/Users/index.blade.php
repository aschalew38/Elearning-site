@php
    use App\Constants;
@endphp
@extends('BackEnd.Layout.base')
@section('title', 'User List')
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
    <form action="" method="POST" id="deleteForm">@csrf @method('DELETE')</form>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"> Users List</h3>
        </div>
        <div class="card-body">
            <div class="card" style="box-shadow: none">
                <div class="card-header">
                    <form class="form-inline card-title" method="Get" action="{{ route('users.index') }}">
                        <div class="input-group ">
                            <input class="form-control" autocomplete="off" name="search" type="search"
                                placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class=" input-group-text btn btn-navbar" type="submit" value="filter_form_single"
                                    name="filter" value="filter">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="d-flex justify-content-end">
                        {{-- <a class="btn btn-primary btn-sm mr-1" href=""><i class="fa fa-plus mr-2"></i> Sync UAS</a> --}}

                        <a class="btn btn-primary btn-m" href="{{ route('users.create') }}"><i class="fa fa-plus mr-2"></i>
                            New
                            User</a>
                    </div>
                </div>
            </div>
            {{-- <hr> --}}


            <table id="exam_table" class="table table-bordered table-hover mt-2">
                <thead>
                    <tr>
                        <th class="col-md-4 px-4">Full name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @if (count($users) < 1)
                        <tr>
                            <td colspan="4" class="text-center">
                                No users Found
                            </td>
                        </tr>
                    @endif
                    @foreach ($users as $user)
                        @if ($user->hasRole(Constants::SUPER_ADMIN_ROLE))
                            @continue
                        @endif
                        <tr>
                            <td class="px-4">{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles()->pluck('name') }}</td>
                            <td>
                                <a href="{{ route('users.show', ['user' => $user->id]) }}" class="mr-2">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if ($user->is_ldap_user == false)
                                    <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="mr-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#"
                                        onclick="deleteEntry('{{ route('users.destroy', ['user' => $user->id]) }}')"
                                        class="mr-2 text-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="px-5 py-2 d-flex justify-content-end">
                @if (method_exists($users, 'links'))
                    {{ $users->links() }}
                @endif
            </div>
            <div class="px-5 py-2 d-flex justify-content-end">
            </div>
        </div>
    </div>
@endsection
