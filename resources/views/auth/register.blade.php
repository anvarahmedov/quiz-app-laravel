<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-slot name="logo_text">
            <x-auth-text />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Ism') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Parol') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Parolni tasdiqlash') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="form-group mt-3">
                {!! NoCaptcha::renderJs('uz', false, 'onloadCallBack') !!}
                {!! NoCaptcha::display() !!}
            </div>


            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __("Akkountingiz bormi?") }}
                </a>

                <x-button class='ms-4'>
                    {{ __('Registratsiya') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>

    @push('scripts')
    <script>
        var onloadCallBack = function() {
            alert('grecaptcha is ready!');
        }
    </script>
    @endpush

</x-guest-layout>
