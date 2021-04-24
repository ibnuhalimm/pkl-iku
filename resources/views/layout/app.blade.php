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

</head>
<body class="bg-gray-50">

    <header class="fixed top-0 left-0 w-full border border-solid border-t-0 border-r-0 border-l-0 border-gray-200 bg-white">
        <nav class="flex flex-row items-center justify-between xl:justify-end">
            <div class="w-full h-full fixed inset-0 z-20 transition-opacity duration-500 opacity-0 pointer-events-none" id="__sidebarBackdrop">
                <div class="absolute w-full h-full bg-gray-900 bg-opacity-50 z-40"></div>
            </div>
            <div class="transform -translate-x-full xl:translate-x-0 fixed top-0 left-0 w-[63%] sm:w-1/3 lg:w-1/4 xl:w-52 h-full bg-white xl:bg-transparent ease-in-out transition-all duration-300 z-30 border lg:border-0 border-solid border-t-0 border-r-0 border-b-0 border-gray-100" id="__sidebarMenu">
                <div class="w-full h-full flex flex-col overflow-y-auto">
                    <div class="w-1/2 xl:w-full py-4 mb-5">
                        <a href="#" class="block h-8 w-24 xl:w-20 mx-4 xl:mx-auto xl:relative xl:-top-1">
                            <img src="{{ asset('img/logo.png') }}" alt="PKL IKU" class="w-full h-auto">
                        </a>
                    </div>
                    <div class="w-full">
                        <a href="#" class="w-11/12 px-4 xl:px-6 py-3 xl:py-2 text-gray-600 xl:text-iku-primary inline-flex items-center rounded-full rounded-tl-none rounded-bl-none bg-iku-primary bg-opacity-10 xl:bg-transparent">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="ml-4">
                                Dashboard
                            </span>
                        </a>
                        <hr class="xl:hidden my-2 border border-r-0 border-b-0 border-l-0 border-gray-400">
                        <a href="#" class="w-11/12 px-4 xl:px-6 py-3 xl:py-2 text-gray-600 hover:text-gray-800 xl:hover:text-iku-primary inline-flex items-center rounded-full rounded-tl-none rounded-bl-none">
                            <i class="fas fa-user-cog"></i>
                            <span class="ml-4">
                                Setting
                            </span>
                        </a>
                        <a href="{{ route('logout') }}" class="w-11/12 px-4 xl:px-6 py-3 xl:py-2 text-gray-600 hover:text-gray-800 xl:hover:text-iku-primary inline-flex items-center rounded-full rounded-tl-none rounded-bl-none">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="ml-5">
                                Log out
                            </span>
                        </a>
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
            <div class="w-1/3 py-3 xl:hidden">
                <a href="#" class="block h-8 w-20 mx-auto">
                    <img src="{{ asset('img/logo.png') }}" alt="PKL IKU">
                </a>
            </div>
            <div class="w-1/3 xl:pr-5">
                <a href="#" class="p-5 md:px-10 xl:py-4 outline-none focus:outline-none float-right">
                    <i class="far fa-user-circle text-xl text-gray-600"></i>
                </a>
            </div>
        </nav>
    </header>

    <main class="mt-20 xl:ml-52">
        <div class="px-5 xl:px-10">
            @yield('content')
        </div>
    </main>

    <script src="{{ asset('js/sidebar-nav.js') }}"></script>

</body>
</html>