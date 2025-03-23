@extends('BackEnd.Layout.base')
@push('css')
    <link rel="stylesheet" href="{{ asset('BackEnd/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endpush
@push('js')
    <script src="{{ asset('BackEnd/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
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
            <h3 class="card-title">{{ $role->name }}</h3>
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
                    <form method="POST" action="{{ route('role.permission.assign', ['role' => $role->id]) }}">
                        @csrf
                        <div class="form-group">
                            <label>Select Permission</label>
                            <select name="permissions[]" class="duallistbox" multiple="multiple">
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->id }}"
                                        {{ $role->hasPermissionTo($permission->name) ? 'selected' : '' }}>
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
