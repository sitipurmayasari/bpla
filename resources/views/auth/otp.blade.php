<x-authentication-layout>
    <h1 class="text-3xl text-slate-800 dark:text-slate-100 font-bold mb-6">{{ __('Verifikasi OTP Anda!') }}</h1>

    @if (session()->has('success'))
        @include('components.alert-success')
    @endif
    @if (session()->has('error'))
        @include('components.alert-danger')
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('otp.verify') }}">
        @csrf
        <div class="space-y-4">
            <input type="hidden">
            <div>
                <input type="hidden" name="phone" value="{{ request()->segment(2) }}">
                <x-jet-label for="otp" value="{{ __('Kode OTP Anda') }}" />
                <x-jet-input id="otp" type="number" name="otp" required />
            </div>
        </div>
        <div class="flex items-center justify-between mt-6">

            <x-jet-button class="ml-3">
                {{ __('VERIFIKASI') }}
            </x-jet-button>
        </div>
    </form>
    <x-jet-validation-errors class="mt-4" />
    <!-- Footer -->
    <div class="pt-5 mt-6 border-t border-slate-200">
        <div class="text-sm">
            {{ __('Don\'t you have an account?') }} <a class="font-medium text-indigo-500 hover:text-indigo-600"
                href="{{ route('register') }}">{{ __('Sign Up') }}</a>
        </div>

    </div>
</x-authentication-layout>
