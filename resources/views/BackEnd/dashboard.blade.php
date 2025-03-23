@extends('BackEnd.Layout.base')
@section('title', 'Dashboard')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-2">
                <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-0 fw-semibold">Users</p>
                                <p class="mb-0 text-truncate text-muted"><span class="text-success"> {{$users}}</span>
                                    </p>

                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon bg-light-alt">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
            <div class="col-md-6 col-lg-4">
                <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-0 fw-semibold"> Courses</p>
                                {{-- <h3 class="m-0"></h3> --}}
                                <p class="mb-0 text-truncate">Active
                                   <span class="mx-4"> {{$courses_active}}</span>
                             Pending
                                    <span class="mx-3">{{$courses_pending}}</span></p>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon bg-light-alt">
                                    <i class="fas fa-book"></i>
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock align-self-center text-muted icon-sm"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>   --}}
                                </div>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
            <div class="col-md-6 col-lg-2">
                <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-0 fw-semibold">Blogs</p>
                                <h3 class="m-0">{{$blogs}}</h3>

                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon bg-light-alt">
                                    <i class="fas fa-blog"></i>
                                </div>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
            <div class="col-md-5 col-lg-3">
                <div class="card report-card">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col">
                                <p class="text-dark mb-0 fw-semibold">Digital Solution</p>
                                <h3 class="m-0">{{$ds_active}}</h3>

                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon bg-light-alt">
                                    <i class="fas fa-desktop"></i>
                                </div>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->



        </div><!--end row-->


        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">User &amp; Roles </h4>
                            </div><!--end col-->
                        </div>  <!--end row-->
                    </div><!--end card-header-->
                    <div class="card-body">
                        <div class="table-responsive browser_users">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-top-0 col-md-8">Role</th>
                                        <th class="border-top-0">users N<u>o</u></th>
                                        <th class="border-top-0">% </th>

                                    </tr><!--end tr-->
                                </thead>
                                <tbody>
                                 @if($roles?->sum("users_count")==0)
                                        <tr>
                                            <td colspan="2" class="text-center">NO Users Found</td>
                                        </tr>
                                 @else
                                 @foreach($roles as $role)
                                    <tr>
                                        <td><a class="text-primary">{{$role->name}}</a></td>
                                        <td>{{$role->users_count}}
                                        </td>
                                        <td>
                                            <small class="text-muted">{{$role->users_count/$roles->sum("users_count")*100}}%</small></td>

                                    </tr><!--end tr-->
                                  @endforeach
                                @endif

                                </tbody>
                            </table> <!--end table-->
                        </div><!--end /div-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Digital Solution Partners</h4>
                            </div><!--end col-->
                        </div>  <!--end row-->
                    </div><!--end card-header-->
                    <div class="card-body">
                        <div class="table-responsive browser_users">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-top-0">Type</th>
                                        <th class="border-top-0">Number</th>

                                    </tr><!--end tr-->
                                </thead>
                                <tbody>
                                    @foreach($partners as $pt)
                                    <tr>
                                        <td>{{$pt->type}}</td>
                                        <td>{{$pt->amount}}</td>

                                    </tr><!--end tr-->
                                   @endforeach

                                </tbody>
                            </table> <!--end table-->
                        </div><!--end /div-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
       </div>
 @endsection
