@switch($color)
    @case('primary')
        <button {{ $attributes->merge([
            'type' => 'button',
            'class' => 'block w-full px-4 py-3 text-center text-base bg-iku-primary hover:bg-opacity-80 shadow-md text-white font-bold border border-solid border-gray-300 rounded-full outline-none focus:outline-none transition duration-300'
        ]) }}>
            {{ $slot }}
        </button>
        @break
    @case('secondary')
        <button {{ $attributes->merge([
            'type' => 'button',
            'class' => 'block w-full px-4 py-3 text-center text-base bg-iku-secondary hover:bg-opacity-80 shadow-md text-white font-bold border border-solid border-gray-300 rounded-full outline-none focus:outline-none transition duration-300'
        ]) }}>
            {{ $slot }}
        </button>
        @break
    @case('red')
        <button {{ $attributes->merge([
            'type' => 'button',
            'class' => 'block w-full px-4 py-3 text-center text-base bg-red-500 hover:bg-opacity-80 shadow-md text-white font-bold border border-solid border-gray-300 rounded-full outline-none focus:outline-none transition duration-300'
        ]) }}>
            {{ $slot }}
        </button>
        @break
    @case('green')
        <button {{ $attributes->merge([
            'type' => 'button',
            'class' => 'block w-full px-4 py-3 text-center text-base bg-green-500 hover:bg-opacity-80 shadow-md text-white font-bold border border-solid border-gray-300 rounded-full outline-none focus:outline-none transition duration-300'
        ]) }}>
            {{ $slot }}
        </button>
        @break
    @case('dark')
        <button {{ $attributes->merge([
            'type' => 'button',
            'class' => 'block w-full px-4 py-3 text-center text-base bg-iku-dark hover:bg-opacity-80 shadow-md text-white font-bold border border-solid border-gray-300 rounded-full outline-none focus:outline-none transition duration-300'
        ]) }}>
            {{ $slot }}
        </button>
        @break
    @default
        <button {{ $attributes->merge([
            'type' => 'button',
            'class' => 'block w-full px-4 py-3 text-center text-base bg-iku-gray hover:bg-opacity-80 shadow-md text-iku-dark font-bold border border-solid border-gray-300 rounded-full outline-none focus:outline-none transition duration-300'
        ]) }}>
            {{ $slot }}
        </button>

@endswitch