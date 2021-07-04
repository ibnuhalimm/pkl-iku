@props(['isRequired'])

@php
    $isRequiredAttribute = $isRequired ?? false;
@endphp

<label {{ $attributes->merge([
    'class' => 'block mb-2'
]) }}>
    {{ $slot }}
    @if ($isRequiredAttribute === 'true') <span class="text-red-500">*</span> @endif
</label>