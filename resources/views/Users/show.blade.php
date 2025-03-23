@php
    use App\Constants;
@endphp
@extends('BackEnd.Layout.base')
@push('css')
    <link rel="stylesheet" href="{{ asset('Backend/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endpush
@push('js')
    <script src="{{ asset('Backend/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script>
        $(function() {
            $('.duallistbox').bootstrapDualListbox()
        })
    </script>
@endpush
@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Manage Permission</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <form method="POST" action="{{ route('user.role.permission.update', ['user' => $user->id]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="role">Select Role</label>
                            <select name="role" id="role" class="select2 form-control">
                                <option value=""></option>
                                @foreach ($roles as $role)
                                    @if ($role->name == Constants::SUPER_ADMIN_ROLE)
                                        @continue
                                    @endif
                                    <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                        {{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Direct Permission</label>
                            <select name="input_permissions[]" class="duallistbox" multiple="multiple">
                                <option value=""></option>
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->id }}"
                                        {{ $user->hasPermissionTo($permission->name) ? 'selected' : '' }}>
                                        {{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Assign Permission" class="btn btn-primary">
                        </div>
                    </form>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /.card -->
@endsection
