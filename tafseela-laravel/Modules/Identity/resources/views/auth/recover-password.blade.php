<x-auth-layout :title="__('identity::auth.recover_password_title')">
    <div class="text-center mb-8">
        <p class="text-sm text-gray-500">{{ __('identity::auth.recover_password_description') }}</p>
    </div>

    <form method="POST" action="{{ route('auth.recover-password') }}">
        @csrf

        <x-auth-input name="email" type="email" :label="__('identity::auth.email')" :placeholder="__('identity::auth.email_placeholder')" required autofocus />

        <div class="mt-8">
            <button type="submit" class="w-full btn-primary py-3 px-4 text-sm font-bold tracking-widest uppercase">
                {{ __('identity::auth.send_recovery_code') }}
            </button>
        </div>

        <p class="mt-8 text-center text-sm text-gray-600">
            <a href="{{ route('auth.signin') }}" class="text-[#A67C52] font-bold hover:underline">
                {{ __('identity::auth.back_to_signin') }}
            </a>
        </p>
    </form>
</x-auth-layout>
