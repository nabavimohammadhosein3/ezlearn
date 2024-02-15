{{-- upper navbar --}}
<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-md d-none d-lg-flex py-0">
    <div class="container d-flex justify-between">
        <div class="col-3">
            <a href="{{ route('dashboard') }}" class="d-flex flex-nowrap items-center h-16 pt-1 navbar-brand logo">
                @include('layouts.nav_items.nav_icon')
            </a>
        </div>
        <div class="col-6">
            <form id="search_form" class="d-flex position-relative w-100 mx-auto" role="search">
                @include('layouts.nav_items.nav_search')
            </form>
        </div>
        <div class="col-3">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown-center ms-auto">
                    @include('layouts.nav_items.nav_account')
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- footer navbar --}}
<nav class="navbar navbar-expand-lg bg-white position-static shadow-md d-none d-lg-flex py-0">
    <div class="container">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-center gap-2">
            @include('layouts.nav_items.nav_footer_items')
        </ul>
    </div>
</nav>

{{-- collapsed navbar --}}
<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-md d-flex d-lg-none py-0">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="d-flex flex-nowrap items-center h-16 pt-1 navbar-brand logo">
            @include('layouts.nav_items.nav_icon')
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#masterNavbar"
            aria-controls="masterNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="masterNavbar">
            <form class="d-flex position-relative w-100 my-3" role="search">
                @include('layouts.nav_items.nav_search')
            </form>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @include('layouts.nav_items.nav_footer_items')
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown-center">
                    @include('layouts.nav_items.nav_account')
                </li>
            </ul>
        </div>
    </div>
</nav>