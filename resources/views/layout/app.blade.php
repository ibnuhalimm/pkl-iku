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

    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css?_=' . rand()) }}">

    <script src="{{ asset('js/app.js?_=' . rand()) }}" defer></script>

</head>
<body class="bg-white">

    <header class="fixed top-0 left-0 w-full border border-solid border-t-0 border-r-0 border-l-0 shadow-sm bg-white">
        <nav class="flex flex-row items-center justify-between xl:justify-end">
            <div class="w-full h-full fixed inset-0 z-20 transition-opacity duration-500 opacity-0 pointer-events-none xl:pointer-events-auto xl:hidden" id="__sidebarBackdrop">
                <div class="absolute w-full h-full bg-gray-900 bg-opacity-50 z-40"></div>
            </div>
            <div class="transform -translate-x-full xl:translate-x-0 fixed top-0 left-0 xl:mt-16 w-[63%] sm:w-1/3 lg:w-1/4 xl:w-64 h-full bg-white ease-in-out transition-all duration-300 z-30 border lg:border-0 border-solid border-t-0 border-r-0 border-b-0 border-gray-100" id="__sidebarMenu">
                <div class="w-full h-full flex flex-col overflow-y-auto">
                    <div class="block xl:hidden w-1/3 mx-auto py-4 mb-5">
                        <a href="{{ route('home') }}" class="block w-full">
                            <img src="{{ asset('img/logo.png?_=' . rand()) }}" alt="{{ config('app.name') }}" class="w-full h-auto">
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
                            <x-sidebar.nav-item :active="false">
                                <x-sidebar.nav-link href="#" :active="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 bi bi-people" viewBox="0 0 16 16">
                                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                                    </svg>
                                    <span class="ml-3">
                                        Mahasiswa
                                    </span>
                                </x-sidebar.nav-link>
                            </x-sidebar.nav-item>
                            <x-sidebar.nav-item :active="false">
                                <x-sidebar.nav-link href="#" :active="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 bi bi-card-heading" viewBox="0 0 16 16">
                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                        <path d="M3 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-1z"/>
                                    </svg>
                                    <span class="ml-3">
                                        Biodata
                                    </span>
                                </x-sidebar.nav-link>
                            </x-sidebar.nav-item>
                            <x-sidebar.nav-item :active="false" x-data="{ subnavOpen: false }">
                                <x-sidebar.nav-link href="#" :active="false" x-on:click="subnavOpen = !subnavOpen">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 bi bi-box-seam" viewBox="0 0 16 16">
                                        <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                                    </svg>
                                    <span class="ml-3">
                                        Master Data
                                    </span>
                                    <span class="absolute left-auto right-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-3 h-3 bi bi-caret-down" viewBox="0 0 16 16">
                                            <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
                                        </svg>
                                    </span>
                                </x-sidebar.nav-link>
                                <x-sidebar.subnav-wrapper x-show="subnavOpen">
                                    <x-sidebar.subnav-item :active="false">
                                        <x-sidebar.subnav-link href="#" :active="false">
                                            Fakultas
                                        </x-sidebar.subnav-link>
                                    </x-sidebar.subnav-item>
                                    <x-sidebar.subnav-item>
                                        <x-sidebar.subnav-link href="#">
                                            Program Studi
                                        </x-sidebar.subnav-link>
                                    </x-sidebar.subnav-item>
                                    <x-sidebar.subnav-item>
                                        <x-sidebar.subnav-link href="#">
                                            Jenjang
                                        </x-sidebar.subnav-link>
                                    </x-sidebar.subnav-item>
                                </x-sidebar.subnav-wrapper>
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
                    <img src="{{ asset('img/logo.png?_=' . rand()) }}" alt="{{ config('app.name') }}">
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

    <script src="{{ asset('js/sidebar-nav.js') }}"></script>

</body>
</html>