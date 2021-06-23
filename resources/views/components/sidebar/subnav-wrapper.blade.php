@props(['active'])

@php
    $cssClass = $active ?? false
                ? 'block'
                : ''
@endphp

<ul {{ $attributes->merge([
    'class' => $cssClass
]) }} style="display:none">
    {{ $slot }}
</ul>