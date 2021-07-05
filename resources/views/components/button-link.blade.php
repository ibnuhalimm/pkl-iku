@props(['color'])

@switch($color)
    @case('primary')
        <a {{ $attributes->merge([
            'href' => '#',
            'class' => 'inline-block h-10 px-3 py-2 text-center text-sm bg-iku-primary hover:bg-opacity-80 shadow-md text-white font-bold border border-solid border-iku-primary rounded-md no-underline outline-none focus:outline-none transition duration-300'
        ]) }}>
            {{ $slot }}
        </a>
        @break
    @case('secondary')
        <a {{ $attributes->merge([
            'href' => '#',
            'class' => 'inline-block h-10 px-3 py-2 text-center text-sm bg-iku-secondary hover:bg-opacity-80 shadow-md text-white font-bold border border-solid border-iku-secondary rounded-md no-underline outline-none focus:outline-none transition duration-300'
        ]) }}>
            {{ $slot }}
        </a>
        @break
    @case('red')
        <a {{ $attributes->merge([
            'href' => '#',
            'class' => 'inline-block h-10 px-3 py-2 text-center text-sm bg-red-500 hover:bg-opacity-80 shadow-md text-white font-bold border border-solid border-red-300 rounded-md no-underline outline-none focus:outline-none transition duration-300'
        ]) }}>
            {{ $slot }}
        </a>
        @break
    @case('green')
        <a {{ $attributes->merge([
            'href' => '#',
            'class' => 'inline-block h-10 px-3 py-2 text-center text-sm bg-green-500 hover:bg-opacity-80 shadow-md text-white font-bold border border-solid border-green-300 rounded-md no-underline outline-none focus:outline-none transition duration-300'
        ]) }}>
            {{ $slot }}
        </a>
        @break
    @case('dark')
        <a {{ $attributes->merge([
            'href' => '#',
            'class' => 'inline-block h-10 px-3 py-2 text-center text-sm bg-iku-dark hover:bg-opacity-80 shadow-md text-white font-bold border border-solid border-gray-700 rounded-md no-underline outline-none focus:outline-none transition duration-300'
        ]) }}>
            {{ $slot }}
        </a>
        @break
    @default
        <a {{ $attributes->merge([
            'href' => '#',
            'class' => 'inline-block h-10 px-3 py-2 text-center text-sm bg-gray-400 hover:bg-opacity-80 shadow-md text-gray-50 font-bold border border-solid border-gray-400 rounded-md no-underline outline-none focus:outline-none transition duration-300'
        ]) }}>
            {{ $slot }}
        </a>

@endswitch