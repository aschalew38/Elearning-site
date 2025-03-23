@extends('layouts.base')
@section('title', 'New User')
@section('content')

    <div class="card card-info col-md-12">
        <div class="card-header">
            <h3 class="card-title">User Update Form</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{ route('user.update',['user'=>$user->id]) }}" class="form-horizontal rouded-full flex gap-2 pl-2">
            @csrf
            @method('PATCH')
            <div class="card-body row">
                <div class="form-group row col-md-6">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="name" placeholder="Full Name">
                        @error('name')
                            <small class="text-red">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row col-md-6">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="email" placeholder="Email">
                        @error('email')
                        <small class="text-red">{{ $message }}</small>
                    @enderror
                    </div>
                </div>

                <div class="form-group row col-md-6">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" value="{{ $user->username }}" class="form-control" id="username" placeholder="Username">
                        @error('username')
                        <small class="text-red">{{ $message }}</small>
                    @enderror
                    </div>
                </div>
                <div class="form-group row col-md-6">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                        @error('password')
                        <small class="text-red">{{ $message }}</small>
                    @enderror
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info float-right">Update</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection
