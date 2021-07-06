@props(['color'])

@switch($color)
    @case('primary')
        <button {{ $attributes->merge([
            'type' => 'button',
            'class' => 'h-10 px-3 py-2 text-center text-sm bg-iku-primary hover:bg-opacity-80 shadow-md text-white font-bold border border-solid border-iku-primary rounded-md outline-none focus:outline-none transition duration-300'
        ]) }}>
            {{ $slot }}
        </button>
        @break
    @case('secondary')
        <button {{ $attributes->merge([
            'type' => 'button',
            'class' => 'h-10 px-3 py-2 text-center text-sm bg-iku-secondary hover:bg-opacity-80 shadow-md text-white font-bold border border-solid border-iku-secondary rounded-md outline-none focus:outline-none transition duration-300'
        ]) }}>
            {{ $slot }}
        </button>
        @break
    @case('red')
        <button {{ $attributes->merge([
            'type' => 'button',
            'class' => 'h-10 px-3 py-2 text-center text-sm bg-red-500 hover:bg-opacity-80 shadow-md text-white font-bold border border-solid border-red-300 rounded-md outline-none focus:outline-none transition duration-300'
        ]) }}>
            {{ $slot }}
        </button>
        @break
    @case('green')
        <button {{ $attributes->merge([
            'type' => 'button',
            'class' => 'h-10 px-3 py-2 text-center text-sm bg-green-500 hover:bg-opacity-80 shadow-md text-white font-bold border border-solid border-green-300 rounded-md outline-none focus:outline-none transition duration-300'
        ]) }}>
            {{ $slot }}
        </button>
        @break
    @case('yellow')
        <button {{ $attributes->merge([
            'type' => 'button',
            'class' => 'h-10 px-3 py-2 text-center text-sm bg-yellow-500 hover:bg-opacity-80 shadow-md text-white font-bold border border-solid border-yellow-300 rounded-md outline-none focus:outline-none transition duration-300'
        ]) }}>
            {{ $slot }}
        </button>
        @break
    @case('dark')
        <button {{ $attributes->merge([
            'type' => 'button',
            'class' => 'h-10 px-3 py-2 text-center text-sm bg-iku-dark hover:bg-opacity-80 shadow-md text-white font-bold border border-solid border-gray-700 rounded-md outline-none focus:outline-none transition duration-300'
        ]) }}>
            {{ $slot }}
        </button>
        @break
    @default
        <button {{ $attributes->merge([
            'type' => 'button',
            'class' => 'h-10 px-3 py-2 text-center text-sm bg-gray-400 hover:bg-opacity-80 shadow-md text-gray-50 font-bold border border-solid border-gray-400 rounded-md outline-none focus:outline-none transition duration-300'
        ]) }}>
            {{ $slot }}
        </button>

@endswitch