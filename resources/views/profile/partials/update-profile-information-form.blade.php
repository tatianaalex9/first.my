<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Данные профиля') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Обновите данные профиля вашей учетной записи и адрес электронной почты.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Имя')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
{{-- Фамилия last_name--}}
        <div>
            <x-input-label for="last_name" :value="__('Фамилия')" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)" required autofocus autocomplete="last_name" />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

{{-- Дата рождения birth_date--}}
        <div>
            <x-input-label for="birth_date" :value="__('Дата рождения')" />
            <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full" :value="old('birth_date', $user->birth_date)" required autofocus autocomplete="birth_date" />
            <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
        </div>
{{-- gender--}}
{{-- checked --}}
        <div>
            <h2 class="fs-6 text-gray-900">Укажите Ваш пол</h2>
            <label for="gender1">Мужчина</label>
            @if($user->gender === "Male")
                <input id="gender1" type="radio" name="gender" value="Male" checked required autofocus autocomplete="gender1">
            @else
                <input id="gender1" type="radio" name="gender" value="Male" required autofocus autocomplete="gender1">
            @endif

            @if($user->gender === "Female")
                <input id="gender2" type="radio" name="gender" value="Female" checked required autofocus autocomplete="gender2">
            @else
                <input id="gender2" type="radio" name="gender" value="Female" required autofocus autocomplete="gender2">
            @endif

            <label for="gender2">Женщина</label>
            {{-- <input id="gender2" type="radio" name="gender" value="Female" :value="old('gender', $user->gender)" required autofocus autocomplete="gender2"> --}}
            {{-- <x-input-error class="mt-2" :messages="$errors->get('gender')" /> --}}
        </div>
{{--end of gender--}}

        <div>
            <x-input-label for="email" :value="__('Электронная почта')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Ваш адрес электронной почты не подтвержден.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Нажмите здесь, чтобы повторно отправить письмо с подтверждением.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('На ваш адрес электронной почты была отправлена новая ссылка для подтверждения.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Сохранить') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
