@extends('BackEnd.Layout.base')
@section('title', 'New User')
@section('content')

    <div class="card card-info col-md-12">
        <div class="card-header">
            <h3 class="card-title">User Registration Form</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{ route('user.store') }}" class="form-horizontal rouded-full flex gap-2 pl-2">
            @csrf
            <div class="card-body row">
                <div class="form-group row col-md-6">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Full Name">
                        @error('name')
                            <small class="text-red">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <!-- <div class="form-group row col-md-6">
                    <label for="name" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                    <select class="form-control" name="role">
                     <option value=""></option>
                         @foreach($roles as $role)
                        
                          <option value="{{$role['name']}}">{{$role['name']}}</option>
                    @endforeach
                    </select>
                        @error('role')
                            <small class="text-red">{{ $message }}</small>
                        @enderror
                    </div>
                </div> -->      
                <div class="form-group row col-md-6">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                        @error('email')
                        <small class="text-red">{{ $message }}</small>
                    @enderror
                    </div>
                </div>

                <div class="form-group row col-md-6">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username">
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
                <button type="submit" class="btn btn-info float-right">Register</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection
