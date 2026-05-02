@props(['disabled' => false, 'label' => null, 'name' => null, 'type' => 'text'])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block font-medium text-sm text-[#1A1A1A] mb-1">
            {{ $label }}
        </label>
    @endif

    <input {{ $disabled ? 'disabled' : '' }} 
           type="{{ $type }}" 
           name="{{ $name }}" 
           id="{{ $name }}"
           {!! $attributes->merge(['class' => 'w-full border-[#E5E7EB] focus:border-[#A67C52] focus:ring-[#A67C52] shadow-sm p-3 placeholder-gray-300 text-sm']) !!}
           style="border-radius: 0;">

    @error($name)
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
