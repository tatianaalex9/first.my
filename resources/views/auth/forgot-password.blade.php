<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Забыли пароль? Без проблем. Просто сообщите нам свой адрес электронной почты, и мы вышлем Вам ссылку для сброса пароля, которая позволит Вам создать новый пароль.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Ссылка для сброса пароля электронной почты') }}
                <!-- {{ __('Email Password Reset Link') }} -->
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
