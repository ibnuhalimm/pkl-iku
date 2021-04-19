<label {{ $attributes->merge([
    'class' => 'block mb-2'
]) }}>
    {{ $slot }}
    @if ($isRequired === 'true') <span class="text-red-500">*</span> @endif
</label>