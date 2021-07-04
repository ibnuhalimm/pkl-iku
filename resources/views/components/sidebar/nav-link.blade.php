@props(['active'])

@php
    $cssClass = $active ?? false
            ? 'nav-link w-full px-4 py-3 xl:py-2 relative inline-flex items-center text-blue-600'
            : 'nav-link w-full px-4 py-3 xl:py-2 relative inline-flex items-center text-gray-600'
@endphp

<a {{ $attributes->merge([
    'href' => '#',
    'class' => $cssClass
]) }}>
    {{ $slot }}
</a>