<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('img/LOGO2.png') }}" width="200" heigth="200"/>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="identification" value="{{ __('Identification') }}" />
                <x-jet-input id="identification" class="block mt-1 w-full" type="text" name="identification" :value="old('identification')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Recuerda Contraseña') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-green-600 hover:text-green-900" style="margin:2.5%" href="{{ route('register') }}">
                        {{ __('Crear Una Cuenta') }}
                </a>

                            
               {{--  @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Olvido Su Password?') }}
                    </a>
                @endif --}}

                <x-jet-button class="ml-4">
                    {{ __('Ingresar') }}
                </x-jet-button>

                
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
