<div class="topbar py-1">
    <!-- Navbar -->
    <nav class="navbar-custom">
        <a class="btn btn-primary" href="{{ route('dashboard') }}">Home</a>
        <ul class="list-unstyled topbar-nav float-end mb-0 pt-2">
            <li class="dropdown hide-phone">
                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-bs-toggle="dropdown"
                    href="index.html#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i data-feather="search" class="topbar-icon"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-end dropdown-lg p-0">
                    <!-- Top Search Bar -->
                    <div class="app-search-topbar">
                        <form action="index.html#" method="get">
                            <input type="search" name="search" class="from-control top-search mb-0"
                                placeholder="Type text...">
                            <button type="submit"><i class="ti-search"></i></button>
                        </form>
                    </div>
                </div>
            </li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-bs-toggle="dropdown"
                    href="index.html#" role="button" aria-haspopup="false" aria-expanded="false">
                    {{-- <i data-feather="bell" class="align-self-center topbar-icon"></i> --}}
                    <span class="badge bg-primary">My Courses</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-lg pt-0">

                    <h6
                        class="dropdown-item-text font-15 m-0 py-3 border-bottom d-flex justify-content-between align-items-center">
                        Enrolled Courses <span class="badge bg-primary rounded-pill"></span>
                    </h6>
                    <div class="notification-menu" data-simplebar>
                        <!-- item-->
                       {{-- @dd(auth()->user()->enrolled_courses()) --}}
                         @foreach (auth()->user()->enrolled_courses() as $cs)
                            <div class="d-flex my-1 mx-2">
                                <img src="{{ asset('storage/' . $cs->poster) }}" alt=""
                                    class="thumb-sm rounded-circle">
                                {{-- @dd($c->id); --}}
                                <a href="{{ route('course.show', ['course' => $cs->course_id]) }}" class="dropdown-item py-3">
                                    {{ $cs->name }}
                                    <!--end media-->
                                </a>
                            </div>
                        @endforeach
                       {{-- @endif --}}
                    </div>
                </div>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-bs-toggle="dropdown"
                    href="index.html#" role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="ms-1 nav-user-name hidden-sm">{{ Auth::user()->username }}</span>
                    <img src="{{ asset('BackEnd/assets/images/users/user-5.jpg') }}" alt="profile-user"
                        class="rounded-circle thumb-xs" />
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="index.html#"><i data-feather="user"
                            class="align-self-center icon-xs icon-dual me-1"></i> Profile</a>
                    <a class="dropdown-item" href="index.html#"><i data-feather="settings"
                            class="align-self-center icon-xs icon-dual me-1"></i> Settings</a>
                    <div class="dropdown-divider mb-0"></div>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item"><i data-feather="power"
                                class="align-self-center icon-xs icon-dual me-1"></i>
                            Logout </button>
                    </form>
                </div>
            </li>
        </ul>
        <!--end topbar-nav-->

        {{--  <ul class="list-unstyled topbar-nav mb-0">
            <li>
                <button class="nav-link button-menu-mobile">
                    <i data-feather="menu" class="align-self-center topbar-icon"></i>
                </button>
            </li>
            <li class="creat-btn">
                <div class="nav-link">
                    <a class=" btn btn-sm btn-soft-primary" href="index.html#" role="button"><i class="fas fa-plus me-2"></i>New Task</a>
                </div>
            </li>
        </ul>  --}}
    </nav>
    <!-- end navbar-->
</div>
