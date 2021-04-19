@switch($color)
    @case('red')
        <div {{ $attributes->merge([
            'class' => 'my-4 px-4 py-2 rounded-lg bg-red-100 text-red-600'
        ]) }}>
            {{ $slot }}
        </div>
        @break

    @case('green')
        <div {{ $attributes->merge([
            'class' => 'my-4 px-4 py-2 rounded-lg bg-green-100 text-green-600'
        ]) }}>
            {{ $slot }}
        </div>
        @break

    @case('yellow')
        <div {{ $attributes->merge([
            'class' => 'my-4 px-4 py-2 rounded-lg bg-yellow-100 text-yellow-600'
        ]) }}>
            {{ $slot }}
        </div>
        @break

    @default
        <div {{ $attributes->merge([
            'class' => 'my-4 px-4 py-2 rounded-lg bg-blue-100 text-blue-600'
        ]) }}>
            {{ $slot }}
        </div>
@endswitch