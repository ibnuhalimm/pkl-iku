<a href="#" {{ $attributes->merge([
    'class' => 'underline text-iku-primary hover:opacity-80 transition duration-300'
]) }}>
    {{ $slot }}
</a>