<x-auth-layout :title="__('identity::auth.signin_title')" icon="fa-sign-in-alt">
    <form method="POST" action="{{ route('auth.signin') }}">
        @csrf

        <x-auth-input name="email" type="email" :label="__('identity::auth.email')" :placeholder="__('identity::auth.email_placeholder')" required autofocus />
        
        <div class="mt-4">
            <x-auth-input name="password" type="password" :label="__('identity::auth.password')" :placeholder="__('identity::auth.password_placeholder')" required />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="remember" class="border-[#E5E7EB] text-[#A67C52] focus:ring-[#A67C52]" style="border-radius: 0;">
                <span class="ms-2 text-sm text-gray-600">{{ __('identity::auth.remember_me') }}</span>
            </label>

            <a class="text-sm text-[#A67C52] hover:underline" href="{{ route('auth.recover-password') }}">
                {{ __('identity::auth.forgot_password') }}
            </a>
        </div>

        <div class="mt-8">
            <button type="submit" class="w-full btn-primary py-3 px-4 text-sm font-bold tracking-widest uppercase">
                {{ __('identity::auth.signin_button') }}
            </button>
        </div>

        <div class="relative my-8">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-200"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-4 bg-white text-gray-400">{{ __('identity::auth.or_continue_with') }}</span>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('social.redirect', 'google') }}" class="flex items-center justify-center py-3 px-4 border border-gray-200 hover:bg-gray-50 transition-colors">
                <span class="text-sm font-medium text-[#1A1A1A]">Google</span>
            </a>
            <a href="{{ route('social.redirect', 'facebook') }}" class="flex items-center justify-center py-3 px-4 border border-gray-200 hover:bg-gray-50 transition-colors">
                <span class="text-sm font-medium text-[#1A1A1A]">Facebook</span>
            </a>
        </div>

        <p class="mt-8 text-center text-sm text-gray-600">
            {{ __('identity::auth.dont_have_account') }}
            <a href="{{ route('auth.signup') }}" class="text-[#A67C52] font-bold hover:underline">
                {{ __('identity::auth.signup_link') }}
            </a>
        </p>
    </form>
</x-auth-layout>
