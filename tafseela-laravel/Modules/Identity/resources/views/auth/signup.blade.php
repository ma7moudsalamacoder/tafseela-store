<x-auth-layout :title="__('identity::auth.signup_title')">
    <form method="POST" action="{{ route('auth.signup') }}">
        @csrf

        <x-auth-input name="email" type="email" :label="__('identity::auth.email')" :placeholder="__('identity::auth.email_placeholder')" required autofocus />
        
        <div class="mt-4">
            <x-auth-input name="password" type="password" :label="__('identity::auth.password')" :placeholder="__('identity::auth.password_placeholder')" required />
        </div>

        <div class="mt-4">
            <x-auth-input name="password_confirmation" type="password" :label="__('identity::auth.password_confirmation')" :placeholder="__('identity::auth.password_confirmation_placeholder')" required />
        </div>

        <div class="mt-8">
            <button type="submit" class="w-full btn-primary py-3 px-4 text-sm font-bold tracking-widest uppercase">
                {{ __('identity::auth.signup_button') }}
            </button>
        </div>

        <p class="mt-8 text-center text-sm text-gray-600">
            {{ __('identity::auth.already_have_account') }}
            <a href="{{ route('auth.signin') }}" class="text-[#A67C52] font-bold hover:underline">
                {{ __('identity::auth.signin_link') }}
            </a>
        </p>
    </form>
</x-auth-layout>
