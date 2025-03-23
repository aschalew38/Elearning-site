<nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light bg-lignt border-b">
    <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " style="position: absolute;top:17px;right:10px" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-end align-items-end col-md-12">

                <li class="dropdown mx-4 " style="position: relative;">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user"
                        style="position:absolute;right:10px;top:-10px;"
                    data-bs-toggle="dropdown"
                        href="icons-fontawesome.html#" role="button" aria-haspopup="false" aria-expanded="false">
                        @if(Auth::user()->profile)
                        <img src="{{asset('storage/' .Auth::user()->profile) }}"   alt="profile-user"
                        class="rounded-circle thumb-xs" />
                        @else
                            <i class="fa fa-user"></i>
                        @endif
                        <span class="ms-1 nav-user-name hidden-sm"> {{ Auth::user()?->name }}</span>
                        <span class="ms-1 nav-user-name hidden-sm">
                            {{ Auth::user()->roles->pluck('name')[0] }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" style="position:relative;top:10px;right:10px">
                        <a class="dropdown-item" href="{{route('User.profile',["User"=>Auth::user()->id])}}"><i data-feather="user"
                                class="align-self-center icon-xs icon-dual me-1"></i> Profile</a>
                        <a class="dropdown-item" href="{{route('change_password',["User"=>Auth::user()->id])}}"><i data-feather="settings"
                                class="align-self-center icon-xs icon-dual me-1"></i> Change Password</a>
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

        </div>
    </div>
</nav>
<hr class="" />
