@props(['active'])

@php
    $cssClass = $active ?? false
            ? 'block mb-1 rounded-md bg-iku-primary bg-opacity-10 hover:bg-opacity-20'
            : 'block mb-1 rounded-md bg-transparent hover:bg-gray-100'
@endphp

<li {{ $attributes->merge([
    'class' => $cssClass
]) }}>
    {{ $slot }}
</li>