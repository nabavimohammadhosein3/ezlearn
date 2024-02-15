@if (Auth::user() == null)
<a class="nav-link dropdown-toggle nav-user text-black" href="#" role="button" data-bs-toggle="dropdown"
    aria-expanded="false">حساب</a>
<ul class="dropdown-menu dropdown-menu-end">
    <li><a class="dropdown-item" href="{{ route('register') }}">ثبت نام</a></li>
    <li><a class="dropdown-item" href="{{ route('login') }}">ورود</a></li>
</ul>
@else
<a class="nav-link dropdown-toggle nav-user text-black" href="#" role="button" data-bs-toggle="dropdown"
    aria-expanded="false">{{ Auth::user()->name }}</a>
<ul class="dropdown-menu dropdown-menu-end">
    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">حساب</a></li>
    <li>
        <form class="" action="{{ route('logout') }}" method="post">
            @csrf
            <button class="dropdown-item" type="submit">خروج</button>
        </form>
    </li>
</ul>
@endif