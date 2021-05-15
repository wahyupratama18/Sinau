<x-guest-layout>
    <x-jet-authentication-card>
        
        <x-slot name="logo"></x-slot>
        
        <div class="grid grid-cols-1 md:grid-cols-3">
            
            <div class="hidden md:flex items-center text-center bg-blue-200 text-white px-6 py-4">
                <div class="flex-1 flex items-center justify-center">
                    <x-jet-authentication-card-logo />
                </div>
            </div>
            
            <div class="col-span-2 px-6 py-4">
                <x-jet-validation-errors class="mb-4" />
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
            
                <form method="POST" action="{{ route('login') }}">
                    @csrf
            
                    <div>
                        <x-jet-label for="email" value="{{ __('Email / NIS / NIP') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus />
                    </div>
            
                    <div class="mt-4">
                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>
            
                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-jet-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>
            
                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
            
                        <x-jet-button class="ml-4">
                            {{ __('Log in') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>    
        </div>

    </x-jet-authentication-card>
</x-guest-layout>
