<x-app-layout>
    @if ($package->files()->where('name', 'picture')->first() != null)
    <div class="d-flex justify-center items-center w-100">
        <img src="{{asset($package->files()->where('name', 'picture')->first()->address)}}" class="img-fluid mb-3 col-12 col-md-6 col-lg-4" alt="{{ $package->title }}">
    </div>
    <hr>
    @endif
    <div class="d-flex items-center gap-4 mb-3 flex-wrap justify-center">
        <h1 class="d-inline h-100 items-center mb-0 p-4 py-3" style="font-size: x-large">{{ $package->title }}</h1>
        @if (request()->user() != null and request()->user()->id == $package->user_id)
        <a class="btn btn-app-purple d-inline" href="{{route('packages.edit', ['package' => $package->slug])}}">
            ویرایش کردن
        </a>
        <form action="{{route('packages.destroy', ['package' => $package->slug])}}" method="post">
            @csrf
            @method('delete')
            <button class="btn btn-danger d-inline" type="submit">
                حذف کردن
            </button>
        </form>
        @elseif (!isset($buy))
        <form action="{{route('packages.buy', ['package' => $package->slug])}}" method="post">
            @csrf
            @method('post')
            @if ($package->price == null or $package->price == 0)
            @else
            <button class="btn btn-success d-inline" type="submit">
                {{ $package->price }}&nbsp; تومان
            </button>
            @endif
        </form>
        @endif
    </div>
    <div class="p-4 bg-body-secondary rounded-3 mb-3 overflow-hidden">
        <p class="fade_in_right" style="white-space: pre-wrap">{{ $package->description }}</p>
        @if ($package->files()->where('name', 'video')->first() != null)
        <video src="{{asset($package->files()->where('name', 'video')->first()->address)}}" class="img-fluid mb-4 w-100 fade_in_right d-block " alt="{{ $package->title }}"></video>
        @endif
    </div>
    <div class="bg-body-secondary rounded-3 p-4 overflow-hidden" id="scrolling">
        <p class=" fade_in_right">مدرس دوره : {{ $package->user()->first()->name }}</p>
        <p class=" fade_in_right">سطح دوره : {{ $package->level() }}</p>
        <p class=" fade_in_right">مدت زمان دوره : {{ $package->total_time }} ساعت</p>
        <p class=" fade_in_right">دسته بندی : <a href="{{route('group.show', ['group' => $package->group()->first()->name])}}">{{ $package->group()->first()->name }}</a></p>
        <p class=" fade_in_right">قیمت : @if ($package->price == null or $package->price == 0)رایگان@else{{ $package->price }} تومان@endif</p>
    </div>
    @if (isset($buy) or $package->price == null or $package->price == 0 or (request()->user() != null and request()->user()->id == $package->user_id))
    <div class="bg-body-secondary rounded-3 p-4 mt-3 overflow-hidden">
        <h2 class="h4 fade_in_right">باکس دانلود</h2>
        <hr>
        <a href="" class="fade_in_right p-lg-4">دانلود {{ $package->title }}</a>
    </div>
    @endif
</x-app-layout>