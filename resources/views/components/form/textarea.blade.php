<textarea {{ $attributes->merge([
    'class' => 'block w-full px-3 py-2 border border-solid border-gray-300 rounded-md outline-none focus:outline-none'
]) }}>{{ $slot }}</textarea>