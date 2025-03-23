@php
    use App\Constants;
@endphp
<div class="left-sidenav">
    <!-- LOGO -->
    <div class="brand">
        <a href="{{ route('home') }}" class="logo">
            <div class="d-flex mt-2 align-items-end">
                <img src="{{ asset('Front/assets/img/logo.png') }}" alt="logo" width="50px" class="logo-light" />
                <h4 class="">Digital Solutions</h4>
            </div>
        </a>

        <hr>
    </div>
    <!--end logo-->
    <div class="menu-content h-100" data-simplebar>
        <ul class="metismenu left-sidenav-menu">
            <li>
                <a href="{{ route('dashboard') }}">
                    <i data-feather="home" class="text-primary align-self-center menu-icon"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @can('digitalSolution.create')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('digitalSolution.index') }}">
                    <i class="text-primary fa fa-solid fa-laptop-medical"></i>
                    Digital Solutions
                </a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('ds') }}">
                    <i class="text-primary fa fa-solid fa-laptop-medical"></i>
                    Digital Solutions
                </a>
            </li>
            @endcan
            {{-- @can('digitalSolution.index') --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('additional_resources.index') }}">
                    <i class="text-primary fa fa-solid fa-laptop-medical"></i>
                    Resource
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('partner.index') }}">
                    <i class="text-primary fa fa-solid fa-laptop-medical"></i>
                    Partner
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('contact.index') }}">
                    <i class="fas fa-inbox text-primary"></i>
                    Messages
                </a>
            </li>
            @can('blogs.create')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('blogs.index') }}">
                    <i class="text-primary fa fa-solid fa-laptop-medical"></i>
                    Blogs
                </a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('blogs.all') }}">
                    <i class="text-primary fa fa-solid fa-laptop-medical"></i>
                    Blogs
                </a>
            </li>
            @endcan

            <li>
                <a href="javascript: void(0);">
                    <i class=" text-primary fa fa-solid fa-newspaper"></i>
                    <span>News and Events</span><span class="menu-arrow"><i
                            class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
                    @canany(['news.index', 'news.show'])
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('news.index') }}">
                                <i class="ti-control-record"></i>
                                News
                            </a>
                        </li>
                    @endcan
                    @can('events.index')
                        <li class="nav-item"><a class="nav-link" href="{{ route('event.index') }}">
                                <i class="ti-control-record"></i>
                                Events
                            </a>
                        </li>
                    @endcan

                </ul>
            </li>
            {{-- @canany(['course.index', 'course.show', 'instructors.index']) --}}
            <li>
                <a href="javascript: void(0);">
                    <i class="text-primary fas fa-book-open"></i><span>E-learnig</span><span class="menu-arrow"><i
                            class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
                    {{-- @canany(['course.index', 'course.show']) --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('course.index') }}">
                            <i class="ti-control-record"></i>
                            Courses
                        </a>
                    </li>
                    {{-- @endcan --}}
                    @can('instructors.index')
                        <li class="nav-item"><a class="nav-link" href="{{ route('instructors.index') }}">
                                <i class="ti-control-record"></i>
                                Trainers
                            </a>
                        </li>
                    @endcan

                </ul>
            </li>
            {{-- @endcanany --}}
            <hr class="hr-dashed hr-menu">
            @if (auth()->user()->hasAnyRole([Constants::SUPER_ADMIN_ROLE, Constants::ADMIN_ROLE]))
                <li class="menu-label my-2">Components & Extra</li>
                <li>
                    <a href="javascript: void(0);"><i class="align-self-center fas fa-user-edit menu-icon"></i><span>
                            User
                            Management</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                <i class="ti-control-record"></i>
                                Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('role.index') }}">
                                <i class="ti-control-record"></i>
                                User Roles
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('permission.index') }}"><i
                                    class="ti-control-record"></i>
                                Permissions
                            </a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-cogs"></i><span>Setting</span><span class="menu-arrow"><i
                                class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="{{ route('catagories.index') }}"><i
                                    class="ti-control-record"></i>
                                Sectors</a></li>

                    </ul>
                </li>
            @endif
        </ul>


    </div>
</div>
