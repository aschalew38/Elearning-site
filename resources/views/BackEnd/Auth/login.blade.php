<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Digital Solution Login page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Login Page" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('Front/assets/img/logo.png') }}">

    <!-- App css -->
    <link href="{{ asset('BackEnd/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('BackEnd/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('BackEnd/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="account-body accountbg">

    <!-- Log In page -->
    <div class="container">
        @if (Session::has('success'))
        <p class="alert alert-info bg-success text-white">{{ Session::get('success') }}</p>
    @endif
        <div class="row vh-100 d-flex justify-content-center">
            <div class="col-12 align-self-center">
                <div class="row">
                    <div class="col-md-5 col-lg-4 mx-auto">
                        <div class="card">
                            <div class="card-body p-0 auth-header-box">
                                <div class="text-center p-3">
                                    <a href="{{ route('home') }}" class="logo logo-admin">
                                        <img src="{{ asset('Front/assets/img/logo.png') }}" height="50"
                                            alt="logo" class="auth-logo">
                                    </a>
                                    <h4 class="mt-3 mb-1 fw-semibold text-white font-18">Digital Solution</h4>
                                    <p class="text-muted  mb-0">Sign in to continue.</p>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="nav-border nav nav-pills" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active fw-semibold" data-bs-toggle="tab"
                                            href="auth-login.html#LogIn_Tab" role="tab">Log In</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-semibold" data-bs-toggle="tab"
                                            href="auth-login.html#Register_Tab" role="tab">Register</a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane {{ $errors->has('usernamer') || $errors->has('email') ? '' : 'active' }}"
                                        id="LogIn_Tab" role="tabpanel">
                                        <form class="form-horizontal auth-form" action="{{ route('auth') }}"
                                            method="POST">
                                            @csrf

                                            <div class="form-group mb-2">
                                                <label class="form-label px-3" for="username">Username</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control mx-4" name="username" value="{{ old('username') }}"
                                                        id="username" placeholder="Enter username">
                                                </div>
                                                @error('username')
                                                    <p class="text-danger px-4">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <!--end form-group-->
                                            <div class="form-group mb-2">
                                                <label class="form-label px-3" for="userpassword">Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control mx-4" name="password"
                                                        id="userpassword" value='{{ old('userpassword') }}' placeholder="Enter password">
                                                </div>

                                                @error('password')
                                                    <p class="text-danger pl-4">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-11 m-2 text-end">
                                                <a href="{{ route('forget') }}" class="text-muted font-13"><i class="fas fa-lock"></i> Forgot password?</a>
                                            </div>
                                            <!--end form-group-->
                                            <div class="form-group mb-0 row">
                                                <div class="col-12">
                                                    <button class="btn btn-primary w-100 waves-effect waves-light"
                                                        type="submit">Log In <i class="fas fa-sign-in-alt ms-1"></i>
                                                    </button>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end form-group-->
                                        </form>
                                        <!--end form-->

                                    </div>
                                    <div class="tab-pane px-3 pt-3 {{ $errors->has('usernamer') || $errors->has('email') ? 'active' : '' }}"
                                        id="Register_Tab" role="tabpanel">
                                        <form class="form-horizontal auth-form" action="{{ route('register') }}"
                                            method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label class="form-label " for="name">Full Name</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                                        id="name" placeholder="Enter Name">
                                                </div>
                                                @error('name')
                                                    <p class="text-danger pl-4">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="form-label" for="username">Username</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="usernamer"
                                                        value="{{ old('usernamer') }}" id="username"
                                                        placeholder="Enter username">
                                                </div>
                                                @error('usernamer')
                                                    <p class="text-danger px-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <!--end form-group-->

                                            <div class="form-group mb-2">
                                                <label class="form-label" for="useremail">Email</label>
                                                <div class="input-group">
                                                    <input type="email" class="form-control" name="email"
                                                        value="{{ old('email') }}" id="useremail"
                                                        placeholder="Enter Email">
                                                </div>
                                                @error('email')
                                                    <p class="text-danger px-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <!--end form-group-->

                                            <div class="form-group mb-2">
                                                <label class="form-label" for="userpassword">Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="password"
                                                        value="{{ old('password') }}" id="userpassword"
                                                        placeholder="Enter password">
                                                </div>
                                                @error('password')
                                                    <p class="text-danger px-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <!--end form-group-->

                                            <div class="form-group mb-2">
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


                                            <div class="form-group mb-0 row">
                                                <div class="col-12">
                                                    <button class="btn btn-primary w-100 waves-effect waves-light"
                                                        type="submit">Register <i
                                                            class="fas fa-sign-in-alt ms-1"></i></button>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end form-group-->
                                        </form>
                                        <!--end form-->
                                    </div>
                                </div>
                            </div>
                            <!--end card-body-->
                            <div class="card-body bg-light-alt text-center">
                                <span class="text-muted d-none d-sm-inline-block">Digital Solution ©
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script>
                                </span>
                            </div>
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
    <!-- End Log In page -->




    <!-- jQuery  -->
    <script src="{{ asset('BackEnd/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/js/waves.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/js/simplebar.min.js') }}"></script>


</body>

</html>
