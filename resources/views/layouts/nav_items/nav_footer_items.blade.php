<li class="nav-item">
    <a class="nav-link mt-2 
    @if (strpos(Request::path(), 'dashboard' ) !== false)
        active
    @endif" href="{{route('dashboard')}}">داشبورد</a>
</li>
<li class="nav-item">
    <div class="dropdown">
        <button class="nav-link mt-2 dropdown-toggle
        @if (strpos(Request::path(), 'group' ) !== false)
        active
        @endif" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            دسته بندی
        </button>
        <ul class="dropdown-menu">
            @foreach ($groups as $group)
            @if (count($group->children) != 0)
            <div class="dropend">
                <a href="{{route('group.show', ['group' => $group->name])}}" class="nav-link m-0 dropdown-toggle"
                    aria-expanded="false">
                    {{ $group->name }}
                </a>
                <ul class="dropdown-menu">
                    @foreach ($group->children as $group)
                    @if (count($group->children) != 0)
                    <div class="dropend">
                        <a href="{{route('group.show', ['group' => $group->name])}}" class="nav-link m-0 dropdown-toggle"
                            aria-expanded="false">
                            {{ $group->name }}
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($group->children as $group)
                            <li><a href="{{route('group.show', ['group' => $group->name])}}" class="nav-link dropdown-item">{{ $group->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @else
                    <li><a href="{{route('group.show', ['group' => $group->name])}}" class="nav-link dropdown-item">{{ $group->name }}</a></li>
                    @endif
                    @endforeach
                </ul>
            </div>
            @else
            <li><a href="{{route('group.show', ['group' => $group->name])}}" class="nav-link dropdown-item">{{ $group->name }}</a></li>
            @endif
            @endforeach
        </ul>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link mt-2 
    @if (strpos(Request::path(), 'contact' ) !== false)
        active
    @endif" href="{{route('contact_us')}}">تماس با ما</a>
</li>
