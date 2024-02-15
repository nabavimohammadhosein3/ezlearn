<x-app-layout>
    <form action="{{route('packages.update', ['package' => $package->slug])}}" method="post"
        class="p-4 rounded-4 col-12 col-lg-8">
        @csrf
        @method('put')
        <h1 class="pb-3" style="font-size: x-large">تغییر دوره آموزشی</h1>
        @error('title')
        <p class="alert alert-danger p-2 rounded-2 text-center" dir="ltr">{{ $message }}</p>
        @enderror
        @error('description')
        <p class="alert alert-danger p-2 rounded-2 text-center" dir="ltr">{{ $message }}</p>
        @enderror
        @error('total_time')
        <p class="alert alert-danger p-2 rounded-2 text-center" dir="ltr">{{ $message }}</p>
        @enderror
        @error('price')
        <p class="alert alert-danger p-2 rounded-2 text-center" dir="ltr">{{ $message }}</p>
        @enderror

        <div class="mb-3">
            <label for="title" class="form-label">عنوان</label>
            <input name="title" type="text" class="form-control rounded-5 bg-body-secondary w-75 @error('title')border-danger @enderror" id="title"
                value="{{ old('title',$package->title) }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">توضیحات</label>
            <textarea name="description" class="form-control rounded-4 bg-body-secondary @error('description')border-danger @enderror" id="description" rows="4">{{ old('description',$package->description) }}</textarea>
        </div>
        <div class="mb-3 d-flex items-center flex-wrap row-gap-3 column-gap-5">
            <div class="d-flex items-center">
                <label for="level" class="form-label pe-1 my-0">سطح دوره : </label>
                <select id="level" name="level" class="form-select w-auto rounded-4 bg-body-secondary @error('level')border-danger @enderror" aria-label="Default select example">
                    <option @if ($package->level == 1) selected @endif value="1">مقدماتی</option>
                    <option @if ($package->level == 2) selected @endif value="2">متوسط</option>
                    <option @if ($package->level == 3) selected @endif value="3">پیشرفته</option>
                </select>
            </div>
            <div class="d-flex items-center">
                <label for="group_id" class="form-label pe-1 my-0">دسته بندی : </label>
                <select name="group_id" id="group_id" class="form-select w-auto rounded-4 bg-body-secondary @error('group_id')border-danger @enderror" aria-label="Default select example">
                    @foreach ($groups as $group)
                        <option @if ($group->id == $package->group_id) selected @endif value="{{ $group->id }}">{{ $group->name }}</option>
                        @foreach ($group->children as $children)
                            <option @if ($children->id == $package->group_id) selected @endif value="{{ $children->id }}">{{ $children->name }}</option>
                            @foreach ($children->children as $child)
                                <option @if ($child->id == $package->group_id) selected @endif value="{{ $child->id }}">{{ $child->name }}</option>
                            @endforeach
                        @endforeach
                    @endforeach
                </select>
            </div>
            <div class="d-flex items-center">
                <label for="total_time" class="form-label pe-1 my-0">زمان کل دوره : </label>
                <input value="{{ old('total_time',$package->total_time) }}" placeholder="ساعت" type="number" name="total_time" id="total_time" class="form-control w-auto rounded-4 bg-body-secondary @error('total_time')border-danger @enderror" aria-label="Default select example">
            </div>
            <div class="d-flex items-center">
                <label for="price" class="form-label pe-1 my-0">قیمت : </label>
                <input value="{{ old('price',$package->price) }}" placeholder="تومان" type="number" name="price" id="price" class="form-control w-auto rounded-4 bg-body-secondary @error('price')border-danger @enderror" aria-label="Default select example">
            </div>
        </div>
        <button type="submit" class="btn btn-app-pink mt-1">ذخیره</button>
        <a href="{{ route('packages.upload', ['package' => $package->slug]) }}" class="btn btn-app-purple mt-1 ms-3">فایل های دوره</a>
    </form>
</x-app-layout>