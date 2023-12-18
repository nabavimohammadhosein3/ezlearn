<x-app-layout>
    @foreach ($packages as $package)
    <div class="card mb-3 overflow-hidden">
        <div class="d-flex flex-col flex-lg-row">
            <div class="" style="width: 35vh">
                <img src="{{asset('storage/static/package/default.jpg')}}" class="img-fluid"
                    alt="{{ $package->title }}">
            </div>
            <div class="package-body">
                <div class="card-body ps-4 d-flex flex-col h-100">
                    <h5 class="card-title">
                        <a href="{{route('packages.show', ['package' => $package->slug])}}">
                            {{ $package->title }}
                        </a>
                    </h5>
                    <p class="card-text">{{ Str::limit($package->description, 150) }}</p>
                    <p class="card-text mt-auto">
                        <small class="text-body-secondary">
                            {{ $package->updated_at->diffForHumans() }}
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <hr class="my-4">
    {{ $packages->links() }}
</x-app-layout>