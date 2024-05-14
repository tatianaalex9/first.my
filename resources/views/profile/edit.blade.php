<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Профиль') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="row p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="col-6 max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
                <div class="col-6 d-flex justify-content-center">
                    <div class="text-center mt-4">
                        <img width="432" height="432" class="rounded-circle" src="{{ asset("storage/photos/avatar.png")}}"  alt="..." />
                         <a href="#"><x-primary-button class="px-5 mt-5">{{ __('Изменить аватар') }}</x-primary-button></a>
                         {{-- <a href="{{ route('photos.show', ['photo' => $photo->id]) }}"><x-primary-button class="">{{ __('Посмотреть') }}</x-primary-button></a> --}}
                    </div>                
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
        </div>
    </div>
</x-app-layout>
