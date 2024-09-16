<x-authentication-layout>
    <div class="flex items-center justify-center h-16 px-4 sm:px-6 lg:px-8">
        <!-- Logo -->
        <a class="block" href="{{ route('dashboard') }}">

            <img width="100" height="100" src="{{ asset('images/logo.svg') }}" alt="" srcset="">
        </a>
    </div>
    <br>
    <h1 class="text-3xl text-slate-800 dark:text-slate-100 font-bold mb-6">{{ __('Buat Akun Kamu') }}</h1>
    <!-- Form -->
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="space-y-4">
            <div>
                <x-jet-label for="name">{{ __('NIK *') }} <span class="text-rose-500">*</span></x-jet-label>
                <x-jet-input id="name" type="text" name="nik" :value="old('nik')" required autofocus
                    autocomplete="nik" />
            </div>
            <div>
                <x-jet-label for="name">{{ __('Nama Lengkap') }} <span class="text-rose-500">*</span></x-jet-label>
                <x-jet-input id="name" type="text" name="name" :value="old('name')" required autofocus
                    autocomplete="name" />
            </div>

            <div>
                <x-jet-label for="email">{{ __('Email') }} <span class="text-rose-500">*</span></x-jet-label>
                <x-jet-input id="email" type="email" name="email" :value="old('email')" required />
            </div>

            <div>
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div>
                <x-jet-label for="password_confirmation" value="{{ __('Konfirmasi Password') }}" />
                <x-jet-input id="password_confirmation" type="password" name="password_confirmation" required
                    autocomplete="new-password" />
            </div>
        </div>
        <div class="flex items-center justify-between mt-6">

            <x-jet-button>
                {{ __('Daftar') }}
            </x-jet-button>
        </div>
        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-6">
                <label class="flex items-start">
                    <input type="checkbox" class="form-checkbox mt-1" name="terms" id="terms" />
                    <span class="text-sm ml-2">
                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' =>
                                '<a target="_blank" href="' .
                                route('terms.show') .
                                '" class="text-sm underline hover:no-underline">' .
                                __('Terms of Service') .
                                '</a>',
                            'privacy_policy' =>
                                '<a target="_blank" href="' .
                                route('policy.show') .
                                '" class="text-sm underline hover:no-underline">' .
                                __('Privacy Policy') .
                                '</a>',
                        ]) !!}
                    </span>
                </label>
            </div>
        @endif
    </form>
    <x-jet-validation-errors class="mt-4" />
    <!-- Footer -->
    <div class="pt-5 mt-6 border-t border-slate-200">
        <div class="text-sm">
            {{ __('sudah punya akun?') }} <a class="font-medium text-indigo-500 hover:text-indigo-600"
                href="{{ route('login') }}">{{ __('Sign In') }}</a>
        </div>
    </div>
</x-authentication-layout>
