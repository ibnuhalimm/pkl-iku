<select {{ $attributes->merge([
    'class' => 'block w-full h-10 px-3 py-2 border border-solid border-gray-300 rounded-md outline-none focus:outline-none'
]) }}>
    {{ $slot }}
</select>