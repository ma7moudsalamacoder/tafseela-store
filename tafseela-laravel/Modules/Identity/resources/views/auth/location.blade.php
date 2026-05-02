<x-auth-layout :title="__('identity::auth.location_title')">
    <div class="text-center mb-8">
        <p class="text-sm text-gray-500">{{ __('identity::auth.location_description') }}</p>
    </div>

    <form method="POST" action="{{ route('auth.location') }}">
        @csrf

        <div class="mb-4">
            <label for="city_id" class="block font-medium text-sm text-[#1A1A1A] mb-1">
                {{ __('identity::auth.city') }}
            </label>
            <select name="city_id" id="city_id" class="w-full border-[#E5E7EB] focus:border-[#A67C52] focus:ring-[#A67C52] shadow-sm p-3 text-sm" style="border-radius: 0;" required>
                <option value="">{{ __('identity::auth.select_city') }}</option>
                <option value="1">Cairo</option>
                <option value="2">Alexandria</option>
                <option value="3">Giza</option>
            </select>
            @error('city_id')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <x-auth-input name="state" :label="__('identity::auth.state')" :placeholder="__('identity::auth.state_placeholder')" required />
        
        <x-auth-input name="address_line_1" :label="__('identity::auth.address')" :placeholder="__('identity::auth.address_placeholder')" required />

        <div class="grid grid-cols-2 gap-4">
            <x-auth-input name="building_no" :label="__('identity::auth.building_no')" placeholder="123" />
            <x-auth-input name="floor_no" :label="__('identity::auth.floor_no')" placeholder="5" />
        </div>

        <div class="mt-8">
            <button type="submit" class="w-full btn-primary py-3 px-4 text-sm font-bold tracking-widest uppercase">
                {{ __('identity::auth.complete_registration') }}
            </button>
        </div>
    </form>
</x-auth-layout>
