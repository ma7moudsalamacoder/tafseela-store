<x-auth-layout :title="__('identity::auth.profile_title')">
    <div class="text-center mb-8">
        <p class="text-sm text-gray-500">{{ __('identity::auth.profile_description') }}</p>
    </div>

    <form method="POST" action="{{ route('auth.profile') }}">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <x-auth-input name="first_name" :label="__('identity::auth.first_name')" :placeholder="__('identity::auth.first_name_placeholder')" required />
            <x-auth-input name="last_name" :label="__('identity::auth.last_name')" :placeholder="__('identity::auth.last_name_placeholder')" required />
        </div>

        <x-auth-input name="phone" :label="__('identity::auth.phone')" :placeholder="__('identity::auth.phone_placeholder')" required />

        <div class="mb-4">
            <label for="gender" class="block font-medium text-sm text-[#1A1A1A] mb-1">
                {{ __('identity::auth.gender') }}
            </label>
            <select name="gender" id="gender" class="w-full border-[#E5E7EB] focus:border-[#A67C52] focus:ring-[#A67C52] shadow-sm p-3 text-sm" style="border-radius: 0;">
                <option value="">{{ __('identity::auth.select_gender') }}</option>
                <option value="male">{{ __('identity::auth.gender_male') }}</option>
                <option value="female">{{ __('identity::auth.gender_female') }}</option>
                <option value="other">{{ __('identity::auth.gender_other') }}</option>
            </select>
            @error('gender')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-8">
            <button type="submit" class="w-full btn-primary py-3 px-4 text-sm font-bold tracking-widest uppercase">
                {{ __('identity::auth.save_and_continue') }}
            </button>
        </div>
    </form>
</x-auth-layout>
