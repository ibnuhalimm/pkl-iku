<div {{ $attributes->merge() }}>
    <div class="w-full fixed bg-black bg-opacity-70 inset-0 z-30">
        <div class="w-full h-screen overflow-y-auto">
            <div class="bg-white w-11/12 sm:w-1/2 md:w-1/2 lg:w-1/3 lg:max-w-sm mx-auto rounded-lg text-left my-10">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>