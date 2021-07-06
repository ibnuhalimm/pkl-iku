<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        {{ config('app.name') }}
        @hasSection ('title')
            - @yield('title')
        @endif
    </title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com/" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net/" crossorigin>
    <link rel="preconnect" href="https://cdn.datatables.net/" crossorigin>
    <link rel="dns-prefetch" href="https://fonts.googleapis.com/">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net/">
    <link rel="dns-prefetch" href="https://cdn.datatables.net/">

    @stack('top_css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css?_=' . rand()) }}">
    @stack('bottom_css')

    <script src="{{ asset('js/app.js?_=' . rand()) }}" defer></script>

</head>
<body class="bg-white">

    <header class="fixed top-0 left-0 w-full border border-solid border-t-0 border-r-0 border-l-0 shadow-sm bg-white z-10">
        <nav class="flex flex-row items-center justify-between xl:justify-end">
            <div class="w-full h-full fixed inset-0 z-20 transition-opacity duration-500 opacity-0 pointer-events-none xl:pointer-events-auto xl:hidden" id="__sidebarBackdrop">
                <div class="absolute w-full h-full bg-gray-900 bg-opacity-50 z-40"></div>
            </div>
            <div class="transform -translate-x-full xl:translate-x-0 fixed top-0 left-0 xl:mt-16 w-[63%] sm:w-1/3 lg:w-1/4 xl:w-64 h-full bg-white ease-in-out transition-all duration-300 z-30 border lg:border-0 border-solid border-t-0 border-r-0 border-b-0 border-gray-100" id="__sidebarMenu">
                <div class="w-full h-full flex flex-col overflow-y-auto pb-10">
                    <div class="block xl:hidden w-1/3 mx-auto py-4 mb-5">
                        <a href="{{ route('home') }}" class="block w-full">
                            <img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }}" class="w-full h-auto">
                        </a>
                    </div>
                    <div class="w-11/12 mx-auto xl:px-2 xl:py-5">
                        <x-sidebar.nav-wrapper>
                            <x-sidebar.nav-item :active="request()->routeIs('home')">
                                <x-sidebar.nav-link :href="route('home')" :active="request()->routeIs('home')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 bi bi-speedometer2" viewBox="0 0 16 16">
                                        <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
                                        <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"/>
                                    </svg>
                                    <span class="ml-3">
                                        Dashboard
                                    </span>
                                </x-sidebar.nav-link>
                            </x-sidebar.nav-item>
                            <x-sidebar.nav-item :active="request()->is('iku*')" x-data="{ subnavOpen: {{ (request()->is('iku*')) ? 'true' : 'false' }} }">
                                <x-sidebar.nav-link href="#" :active="false" x-on:click="subnavOpen = !subnavOpen">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                        <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                                        <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                    </svg>
                                    <span class="ml-3">
                                        Program IKU
                                    </span>
                                    <span class="absolute left-auto right-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-3 h-3 bi bi-caret-down" viewBox="0 0 16 16">
                                            <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
                                        </svg>
                                    </span>
                                </x-sidebar.nav-link>
                                <x-sidebar.subnav-wrapper x-show="subnavOpen">
                                    <x-sidebar.subnav-item :active="request()->is('iku/kerja-layak*')">
                                        <x-sidebar.subnav-link :href="route('iku.kerja-layak.index')" :active="request()->is('iku/kerja-layak*')">
                                            Pekerjaan Layak
                                        </x-sidebar.subnav-link>
                                    </x-sidebar.subnav-item>
                                </x-sidebar.subnav-wrapper>
                            </x-sidebar.nav-item>
                            <x-sidebar.nav-item :active="request()->is('mahasiswa*')">
                                <x-sidebar.nav-link :href="route('mahasiswa.index')" :active="request()->is('mahasiswa*')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 bi bi-people" viewBox="0 0 16 16">
                                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                                    </svg>
                                    <span class="ml-3">
                                        Mahasiswa
                                    </span>
                                </x-sidebar.nav-link>
                            </x-sidebar.nav-item>
                            <x-sidebar.nav-item :active="request()->is('biodata*')">
                                <x-sidebar.nav-link :href="route('biodata.index')" :active="request()->is('biodata*')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 bi bi-card-heading" viewBox="0 0 16 16">
                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                        <path d="M3 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-1z"/>
                                    </svg>
                                    <span class="ml-3">
                                        Biodata
                                    </span>
                                </x-sidebar.nav-link>
                            </x-sidebar.nav-item>

                            <x-sidebar.nav-item :active="request()->is('perusahaan*')" x-data="{ subnavOpen: {{ (request()->is('perusahaan*')) ? 'true' : 'false' }} }">
                                <x-sidebar.nav-link href="#" :active="false" x-on:click="subnavOpen = !subnavOpen">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 bi bi-building" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z"/>
                                        <path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z"/>
                                    </svg>
                                    <span class="ml-3">
                                        Perusahaan
                                    </span>
                                    <span class="absolute left-auto right-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-3 h-3 bi bi-caret-down" viewBox="0 0 16 16">
                                            <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
                                        </svg>
                                    </span>
                                </x-sidebar.nav-link>
                                <x-sidebar.subnav-wrapper x-show="subnavOpen">
                                    <x-sidebar.subnav-item :active="request()->is('perusahaan/data*')">
                                        <x-sidebar.subnav-link :href="route('perusahaan.data.index')" :active="request()->is('perusahaan/data*')">
                                            Data Perusahaan
                                        </x-sidebar.subnav-link>
                                    </x-sidebar.subnav-item>
                                    <x-sidebar.subnav-item :active="request()->is('perusahaan/kategori*')">
                                        <x-sidebar.subnav-link :href="route('perusahaan.kategori.index')" :active="request()->is('perusahaan/kategori*')">
                                            Kategori
                                        </x-sidebar.subnav-link>
                                    </x-sidebar.subnav-item>
                                </x-sidebar.subnav-wrapper>
                            </x-sidebar.nav-item>
                            <x-sidebar.nav-item :active="request()->is('kampus*')" x-data="{ subnavOpen: {{ (request()->is('kampus*')) ? 'true' : 'false' }} }">
                                <x-sidebar.nav-link href="#" :active="false" x-on:click="subnavOpen = !subnavOpen">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 bi bi-bookmark-star" viewBox="0 0 16 16">
                                        <path d="M7.84 4.1a.178.178 0 0 1 .32 0l.634 1.285a.178.178 0 0 0 .134.098l1.42.206c.145.021.204.2.098.303L9.42 6.993a.178.178 0 0 0-.051.158l.242 1.414a.178.178 0 0 1-.258.187l-1.27-.668a.178.178 0 0 0-.165 0l-1.27.668a.178.178 0 0 1-.257-.187l.242-1.414a.178.178 0 0 0-.05-.158l-1.03-1.001a.178.178 0 0 1 .098-.303l1.42-.206a.178.178 0 0 0 .134-.098L7.84 4.1z"/>
                                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                                    </svg>
                                    <span class="ml-3">
                                        Kampus
                                    </span>
                                    <span class="absolute left-auto right-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-3 h-3 bi bi-caret-down" viewBox="0 0 16 16">
                                            <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
                                        </svg>
                                    </span>
                                </x-sidebar.nav-link>
                                <x-sidebar.subnav-wrapper :active="request()->is('kampus*') OR request()->is('prodi*')" x-show="subnavOpen">
                                    <x-sidebar.subnav-item>
                                        <x-sidebar.subnav-link :href="route('kampus.fakultas.index')" :active="request()->is('kampus/fakultas*')">
                                            Fakultas
                                        </x-sidebar.subnav-link>
                                    </x-sidebar.subnav-item>
                                    <x-sidebar.subnav-item>
                                        <x-sidebar.subnav-link :href="route('kampus.prodi.index')" :active="request()->is('kampus/prodi*')">
                                            Program Studi
                                        </x-sidebar.subnav-link>
                                    </x-sidebar.subnav-item>
                                </x-sidebar.subnav-wrapper>
                            </x-sidebar.nav-item>
                            <x-sidebar.nav-item>
                                <x-sidebar.nav-link>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 bi bi-person-check" viewBox="0 0 16 16">
                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                        <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                    </svg>
                                    <span class="ml-3">
                                        User & Hak Akses
                                    </span>
                                </x-sidebar.nav-link>
                            </x-sidebar.nav-item>
                            <x-sidebar.nav-item>
                                <x-sidebar.nav-link :href="route('logout')" :active="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 bi bi-box-arrow-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                                        <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                                    </svg>
                                    <span class="ml-3">
                                        Log out
                                    </span>
                                </x-sidebar.nav-link>
                            </x-sidebar.nav-item>
                        </x-sidebar.nav-wrapper>
                    </div>
                </div>
            </div>

            <div class="w-1/3 xl:hidden">
                <button type="button" class="p-5 md:px-10 outline-none focus:outline-none" id="__btnSidebarOpen">
                    <svg class="h-6 w-6 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <div class="w-1/3 xl:w-2/3 py-3">
                <a href="{{ route('home') }}" class="block h-8 w-20 mx-auto xl:mx-0 xl:ml-20">
                    <img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }}">
                </a>
            </div>
            <div class="w-1/3">
                <a href="#" class="inline-flex items-center p-5 md:px-10 xl:py-4 outline-none focus:outline-none float-right">
                    <i class="far fa-user-circle text-xl text-gray-600"></i>
                    <span class="ml-2 hidden xl:block text-gray-600">
                        {{ Auth::user()->username }}
                    </span>
                </a>
            </div>
        </nav>
    </header>

    <main class="xl:ml-64 py-20 min-h-screen bg-gray-100">
        <div class="px-5">
            @yield('content')
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="{{ asset('js/sidebar-nav.js') }}"></script>
    @stack('bottom_js')

</body>
</html>