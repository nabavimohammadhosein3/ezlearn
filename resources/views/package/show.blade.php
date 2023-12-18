<x-app-layout>
    <img src="{{asset('storage/static/package/default.jpg')}}" class="img-fluid mb-4" alt="{{ $package->title }}">
    <div class="d-flex items-center gap-4 mb-3">
        <h1 class="d-inline h-100 items-center mb-0" style="font-size: x-large">{{ $package->title }}</h1>
        <a class="btn btn-app-pink d-inline" href="{{route('packages.edit', ['package' => $package->slug])}}">
            ویرایش کردن
        </a>
        <form action="{{route('packages.destroy', ['package' => $package->slug])}}" method="post">
            @csrf
            @method('delete')
            <button class="btn btn-app-purple d-inline" type="submit">
                حذف کردن
            </button>
        </form>
    </div>
    <p>{{ $package->description }}</p>
</x-app-layout>