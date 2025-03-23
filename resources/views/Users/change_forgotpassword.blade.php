@extends('Front.Layout.base')
@section('title', 'Reset Password')
@section('content')
    <div class="card card-info col-md-6 mx-auto mt-4">
        <div class="card-header">
            <h3 class="card-title">Change Password Form</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{ route('user.change_forgottenpassword',['user'=>$user->id]) }}"
            class="form-horizontal rouded-full flex gap-2 pl-2">
            @csrf
            <div class="card-body row">

                <div class="form-group col-md-6">
                    <label for="password" class="col-sm-3 col-form-label text-start">Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                        @error('password')
                        <small class="text-red">{{ $message }}</small>
                    @enderror
                    </div>
                </div>
                <div class="form-group mb-2 col-md-5">
                    <label class="form-label" for="conf_password">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control"
                            name="password_confirmation"
                            value="{{ old('password_confirmation') }}" id="conf_password"
                            placeholder="Enter Confirm Password">
                    </div>
                    @error('password_confirmation')
                        <p class="text-danger px-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer d-flex flex-row justify-content-end">
                <button type="submit" class="btn btn-info float-right">Change Password</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection
