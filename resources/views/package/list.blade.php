@if (isset($group))
<div class="w-100 d-flex justify-around items-center flex-wrap">
    <h1 class="fs-4 px-3 m-0 mx-3 py-2">{{ $group->name }}</h1>
    <div class="vr d-none d-md-inline-block"></div>
    <div class="dropdown">
        <button class="link-dark dropdown-toggle rounded-3 fw-bold px-3 py-2 mx-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            مرتب سازی
        </button>
        <ul class="dropdown-menu animate__animated animate__fadeInRight">
            <li><a class="dropdown-item"
                href="{{ request()->fullUrlWithQuery(['sort' => 'price']) }}">ارزان ترین</a></li>
            <li><a class="dropdown-item"
                href="{{ request()->fullUrlWithQuery(['sort' => 'price desc']) }}">گران ترین</a></li>
            <li><a class="dropdown-item"
                href="{{ request()->fullUrlWithQuery(['sort' => 'total_time']) }}">بیشترین زمان دوره</a></li>
            <li><a class="dropdown-item"
                href="{{ request()->fullUrlWithQuery(['sort' => 'total_time desc']) }}">کمترین زمان دوره</a></li>
            <li><a class="dropdown-item"
                href="{{ request()->fullUrlWithQuery(['sort' => 'id desc']) }}">جدید ترین</a></li>
            <li><a class="dropdown-item"
                href="{{ request()->fullUrlWithQuery(['sort' => 'id']) }}">قدیمی ترین</a></li>
            <li><a class="dropdown-item"
                href="{{ request()->fullUrlWithQuery(['sort' => 'level']) }}">پایین ترین سطح</a></li>
            <li><a class="dropdown-item"
                href="{{ request()->fullUrlWithQuery(['sort' => 'level desc']) }}">بالا ترین سطح</a></li>
        </ul>
    </div>
    <div class="vr d-none d-md-inline-block"></div>
    <div class="d-flex justify-between items-center flex-wrap mx-3">
    @foreach ($group->children as $i)
    <a class="fs-5 px-2 mx-1 g-links border-3 text-nowrap" href="{{route('group.show', ['group' => $i->name])}}">{{ $i->name }}</a>
    @endforeach
    </div>
</div>
<hr class="mb-4">
@else
<div class="w-100 d-flex items-center flex-wrap">
    <div class="dropdown">
        <button class="link-dark dropdown-toggle rounded-3 fw-bold px-3 py-2 mx-3 my-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            مرتب سازی
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item"
                href="{{ request()->fullUrlWithQuery(['sort' => 'price']) }}">ارزان ترین</a></li>
            <li><a class="dropdown-item"
                href="{{ request()->fullUrlWithQuery(['sort' => 'price desc']) }}">گران ترین</a></li>
            <li><a class="dropdown-item"
                href="{{ request()->fullUrlWithQuery(['sort' => 'total_time']) }}">بیشترین زمان دوره</a></li>
            <li><a class="dropdown-item"
                href="{{ request()->fullUrlWithQuery(['sort' => 'total_time desc']) }}">کمترین زمان دوره</a></li>
            <li><a class="dropdown-item"
                href="{{ request()->fullUrlWithQuery(['sort' => 'id desc']) }}">جدید ترین</a></li>
            <li><a class="dropdown-item"
                href="{{ request()->fullUrlWithQuery(['sort' => 'id']) }}">قدیمی ترین</a></li>
            <li><a class="dropdown-item"
                href="{{ request()->fullUrlWithQuery(['sort' => 'level']) }}">پایین ترین سطح</a></li>
            <li><a class="dropdown-item"
                href="{{ request()->fullUrlWithQuery(['sort' => 'level desc']) }}">بالا ترین سطح</a></li>
        </ul>
    </div>
</div>
<hr class="mb-4">
@endif
@foreach ($packages as $package)
<div class="card mb-3 overflow-hidden">
        <div class="d-flex flex-col flex-lg-row fade_in_right">
            <div class="" style="width: 35vh">
                <a href="{{route('packages.show', ['package' => $package->slug])}}">
                @if ($package->files()->where('name', 'picture')->first() == null)
                    <img src="{{asset('storage/static/package/default.jpg')}}" class="img-fluid"
                        alt="{{ $package->title }}">
                @else
                    <img src="{{asset($package->files()->where('name', 'picture')->first()->address)}}" alt="{{ $package->title }}">
                @endif
                </a>
            </div>
            <div class="package-body">
                <div class="card-body ps-4 d-flex flex-col h-100">
                    <h5 class="card-title">
                        <a href="{{route('packages.show', ['package' => $package->slug])}}">
                            {{ $package->title }}
                        </a>
                    </h5>
                    <p class="card-text">{{ Str::limit($package->description, 150) }}</p>
                    <p class="card-text mt-auto text-success">@if ($package->price == null or $package->price == 0)رایگان@else{{ $package->price }} تومان@endif</p>
                    <p class="card-text">
                        <small class="text-body-secondary">
                            آخرین بروزرسانی {{ $package->updated_at->diffForHumans() }}
                        </small>
                    </p>
                </div>
            </div>
        </div>
</div>
@endforeach
@if (count($packages) == 0)
    <div class=" text-center w-100">هیچ دوره آموزشی وجود ندارد ...</div>
@endif
@if(method_exists($packages, 'links'))
<hr class="my-4">
{{$packages->withQueryString()->links()}}
@endif