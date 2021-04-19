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
    <link rel="stylesheet" href="{{ asset('css/app.css?_=' . rand()) }}">
</head>
<body>

    <main>
        @yield('content')
    </main>

    @stack('bottom_js')

</body>
</html>