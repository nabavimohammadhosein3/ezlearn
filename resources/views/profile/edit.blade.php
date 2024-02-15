<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <ul class="nav nav-tabs">
                <li class="nav-item
                    @if (strpos(Request::path(), 'profile/buy' ) === false and strpos(Request::path(), 'profile/own' ) === false)
                    active
                    @endif">
                    <a class="nav-link pb-3" href="{{ route('profile.edit') }}">اطلاعات حساب</a>
                </li>
                <li class="nav-item
                @if (strpos(Request::path(), 'profile/buy' ) !== false)
                active
                @endif">
                <a class="nav-link pb-3" href="{{ route('profile.buy') }}">دوره های خریداری شده</a>
                </li>
                <li class="nav-item
                @if (strpos(Request::path(), 'profile/own' ) !== false)
                active
                @endif">
                <a class="nav-link pb-3" href="{{ route('profile.own') }}">دوره های ثبت شده</a>
                </li>
            </ul>    
            @if (strpos(Request::path(), 'profile/buy' ) !== false)
            @include('package.list')
            @elseif (strpos(Request::path(), 'profile/own' ) !== false)
            <a class="btn btn-app-pink mx-auto" href="{{ route('packages.create') }}">ساخت دوره جدید</a>
            @include('package.list')
            @else
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
