{{-- upper navbar --}}
<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-md d-none d-lg-flex py-0">
    <div class="container d-flex justify-between">
        <div class="col-3">
            <a href="{{ route('dashboard') }}" class="d-flex flex-nowrap items-center h-16 pt-1 navbar-brand logo">
                <x-application-logo class="looka-1j8o68f d-flex items-center" />
                <x-application-name class="text-dark ms-2 ezlearn overflow-hidden fs-6" />
            </a>
        </div>
        <div class="col-6">
            <form class="d-flex position-relative w-100 mx-auto" role="search">
                <input class="form-control me-2 rounded-5" type="search" placeholder="جست و جو ..." aria-label="Search">
                <button class="btn btn-app-pink position-absolute px-4" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="col-3">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown-center ms-auto">
                    <a class="nav-link dropdown-toggle nav-user text-black" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">حساب</a></li>
                        <li>
                            <form class="" action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="dropdown-item" type="submit">خروج</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- footer navbar --}}
<nav class="navbar navbar-expand-lg bg-white position-static shadow-md d-none d-lg-flex py-0">
    <div class="container">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-center">
            <li class="nav-item">
                <a class="nav-link mt-2 
                @if (strpos(Request::path(), 'dashboard' ) !== false)
                    active
                @endif" href="{{route('dashboard')}}">dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mt-2" href="">about us</a>
            </li>
        </ul>
    </div>
</nav>

{{-- collapsed navbar --}}
<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-md d-flex d-lg-none py-0">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="d-flex flex-nowrap items-center h-16 pt-1 navbar-brand logo">
            <x-application-logo class="looka-1j8o68f" />
            <x-application-name class="text-dark ms-2 ezlearn overflow-hidden fs-6" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#masterNavbar"
            aria-controls="masterNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="masterNavbar">
            <form class="d-flex position-relative w-100 my-3" role="search">
                <input class="form-control me-2 rounded-5" type="search" placeholder="جست و جو ..." aria-label="Search">
                <button class="btn btn-app-pink position-absolute px-4" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link mt-2 
                    @if (strpos(Request::path(), 'dashboard' ) !== false)
                        active
                    @endif" href="{{route('dashboard')}}">dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mt-2" href="">about us</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown-center">
                    <a class="nav-link dropdown-toggle nav-user text-black" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">حساب</a></li>
                        <li>
                            <form class="" action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="dropdown-item" type="submit">خروج</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>