<header id="header" class="">
    <div class="container d-md-flex py-1 justify-content-between">
        <div class="social-links text-center text-md-right pt-1 pb-3 pt-md-0">
            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
        <div class="d-flex flex-row-reverse">
            @if(Auth::user())
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="dropdown-item"><i data-feather="power"
                        class="align-self-center icon-xs icon-dual me-1"></i>
                    Logout </button>
            </form>
            @else

            <a class="font-weight-light fs-6 fs-md-4" href="/login">Login|Sigup</a>
            @endif
            <nav class="navbar navbar-light mx-4">
                <form class="form-inline d-lg-flex flex-md-row mx-md-4 gap-md-2" action="{{ route("digitalSolution.search") }}">
                  <input class="form-control mr-md-2" type="search" name="search" placeholder="Search Digital solution" aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
              </nav>
        </div>
    </div>
    <div class="container d-flex align-items-center my-sm-2">
        <h1 class="logo me-auto">
            <a class="active" href="/">
                <img src="{{ asset('Front/assets/img/logo.png') }}" height="50" alt="logo" class="auth-logo">
            </a>
            <a href="{{ route('ds') }}" class="fs-6 fs-md-1 fs-lg-4">Digital Solution</a>
        </h1>
        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="active" href="/">Home</a></li>
                <li><a href="{{ route('add_resource.index') }}">Resource</a></li>
                <li><a href="{{ route('blogs.all') }}">Blog</a></li>
                <li><a href="{{ route('elearning') }}">E-Learning</a></li>
                <li><a href="{{ route('ds') }}">Digital Solution</a></li>
                <li><a href="{{ route('partners') }}">Partners</a></li>
                <li class="dropdown"><a href="#"><span>News and Event</span> <i
                            class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="{{route('new')}}">News</a></li>
                        <li><a href="{{ route('event') }}">Events</a></li>
                    </ul>
                </li>
                <li><a href="{{route("contact")}}">Contact</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <a href="{{route('login')}}" class="get-started-btn">
            @if(Auth::user())
            Dashboard
            @else
            Get Started
            @endif
        </a>
    </div>
    </div>
</header>
