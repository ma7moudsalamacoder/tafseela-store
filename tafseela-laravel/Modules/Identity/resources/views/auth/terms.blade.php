<x-auth-layout :title="__('identity::auth.terms_title')">
    <form method="POST" action="{{ route('auth.terms') }}">
        @csrf

        <div class="h-64 overflow-y-auto border border-gray-100 p-4 mb-6 bg-gray-50 text-xs text-gray-500 leading-relaxed">
            <h3 class="font-bold text-gray-900 mb-2 uppercase">{{ __('identity::auth.terms_and_conditions') }}</h3>
            <p class="mb-4">{{ __('identity::auth.terms_content_placeholder') }}</p>
            <p>{{ __('identity::auth.terms_extra_content') }}</p>
        </div>

        <div class="mb-8">
            <label class="inline-flex items-start">
                <input type="checkbox" name="accepted" class="mt-1 border-[#E5E7EB] text-[#A67C52] focus:ring-[#A67C52]" style="border-radius: 0;" required>
                <span class="ms-3 text-sm text-gray-600 leading-tight">{{ __('identity::auth.terms_accept_label') }}</span>
            </label>
            @error('accepted')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button type="submit" class="w-full btn-primary py-3 px-4 text-sm font-bold tracking-widest uppercase">
                {{ __('identity::auth.continue_button') }}
            </button>
        </div>
    </form>
</x-auth-layout>
