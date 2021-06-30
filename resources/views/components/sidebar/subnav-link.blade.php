@props(['active'])

@php
    $cssClass = $active ?? false
            ? 'block w-full pl-12 pr-2 py-2 rounded-md hover:bg-blue-400 hover:bg-opacity-20 text-blue-600'
            : 'block w-full pl-12 pr-2 py-2 rounded-md hover:bg-blue-400 hover:bg-opacity-20 text-gray-600'
@endphp

<a {{ $attributes->merge([
    'href' => '#',
    'class' => $cssClass
]) }}>
    {{ $slot }}
</a>