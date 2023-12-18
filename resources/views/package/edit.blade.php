<x-app-layout>
    <form action="{{route('packages.update', ['package' => $package->slug])}}" method="post"
        class="p-4 rounded-4 col-12 col-lg-8">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="title" class="form-label">عنوان</label>
            <input name="title" type="text" class="form-control rounded-5 bg-body-secondary w-75" id="title"
                value="{{ old('title',$package->title) }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">توضیحات</label>
            <textarea name="description" class="form-control rounded-4 bg-body-secondary" id="description" rows="4">
                {{ old('description',$package->description) }}
            </textarea>
        </div>
        <button type="submit" class="btn btn-app-pink mt-1">ذخیره</button>
    </form>
</x-app-layout>