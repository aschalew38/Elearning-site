@extends('Front.Layout.base')
@section('title', 'Forgot Password Reset')
@section('content')

<div class="row vh-100 d-flex justify-content-center">


    <div class="col-12 mt-4">
        <div class="row">
            <div class="col-lg-5 mx-auto">
                <div class="card">
                    <div class="card-body p-0 auth-header-box">
                        <div class="text-center p-3 bg-primary">
                            {{-- <a href="index.html" class="logo logo-admin"> --}}
                                <img src="{{ asset('Front/assets/img/logo.png') }}" height="50" alt="logo" class="auth-logo">
                            {{-- </a> --}}
                            <h4 class="mt-3 mb-1 fw-semibold text-white font-18">Reset Password For Dastone</h4>
                            <p class="mb-0 text-white">Enter your Email and instructions will be sent to you!</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal auth-form" action="{{ route('forgetpass') }}" method="POST">
                           @csrf
                            <div class="form-group mb-2">
                                <label class="form-label" for="email">Email</label>
                                <div class="input-group">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
                                </div>
                                @error('email')
                                <p class="text-danger px-4">{{ $message }}</p>
                            @enderror
                            </div><!--end form-group-->

                            <div class="form-group mb-0 row">
                                <div class="col-12 mt-2">
                                    <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Reset <i class="fas fa-sign-in-alt ms-1"></i></button>
                                </div><!--end col-->
                            </div> <!--end form-group-->
                        </form><!--end form-->
                        <p class="text-muted mb-0 mt-3">Remember It ?  <a href="{{ route('login') }}" class="text-primary ms-2">Sign in here</a></p>
                    </div>
                    <div class="card-body bg-light-alt text-center">
                        <span class="text-muted d-none d-sm-inline-block">Digital Solution © <script>
                            document.write(new Date().getFullYear())
                        </script>   </span>
                    </div>
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end col-->
</div>
@endsection
