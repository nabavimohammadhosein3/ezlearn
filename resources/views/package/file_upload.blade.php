<x-app-layout>
    <form action="{{route('packages.file', ['package'=> $package->slug])}}" enctype="multipart/form-data" method="post" class="p-4 rounded-4 col-12 col-lg-8">
        @csrf
        <h1 class="pb-3" style="font-size: x-large">آپلود فایل های دوره</h1>
        @error('picture')
        <p class="alert alert-danger p-2 rounded-2 text-center" dir="ltr">{{ $message }}</p>
        @enderror
        @error('video')
        <p class="alert alert-danger p-2 rounded-2 text-center" dir="ltr">{{ $message }}</p>
        @enderror
        @error('file')
        <p class="alert alert-danger p-2 rounded-2 text-center" dir="ltr">{{ $message }}</p>
        @enderror
        <div class="d-flex flex-col justify-between row-gap-3 ">
            <div class="d-flex items-center flex-wrap row-gap-2">
                <label for="picture" class="form-label pe-1 my-0 text-nowrap" style="width: 14%;" >تصویر :&nbsp;</label>
                <input type="file" accept=".png, .jpg" name="picture" id="picture" class="form-control w-auto rounded-4 bg-body-secondary @error('picture')border-danger @enderror">
            </div>
            <div class="d-flex items-center flex-wrap row-gap-2">
                <label for="video" class="form-label pe-1 my-0 text-nowrap" style="width: 14%;" >فیلم :&nbsp;</label>
                <input type="file" accept=".mp4" name="video" id="video" class="form-control w-auto rounded-4 bg-body-secondary @error('video')border-danger @enderror">
            </div>
            <div class="d-flex items-center flex-wrap row-gap-2">
                <label for="file" class="form-label pe-1 my-0 text-nowrap" style="width: 14%;" >فایل :&nbsp;</label>
                <input type="file" accept=".mp4" name="file" id="file" class="form-control w-auto rounded-4 bg-body-secondary @error('file')border-danger @enderror">
            </div>
        </div>
        <button type="submit" class="btn btn-app-pink mt-3">ذخیره</button>
    </form>
</x-app-layout>