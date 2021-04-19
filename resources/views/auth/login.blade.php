@extends('layout.auth')

@section('title')
    Login
@endsection

@section('content')
    <div class="my-20">
        <div class="w-4/5 sm:w-1/2 md:w-2/5 lg:w-1/3 xl:w-1/4 mx-auto">
            <div class="w-1/2 mx-auto text-center">
                <img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }}" class="w-full h-auto">
            </div>
            <div class="text-center mt-3 mb-6">
                <h1 class="text-2xl font-bold">Login</h1>
            </div>

            @if ($errors->any())
                <x-alert-simple color="red">
                    {{ $errors->first() }}
                </x-alert-simple>
            @endif

            <div class="mb-5">
                <form action="{{ route('login') }}" method="post">
                    {{ csrf_field() }}
                    <x-form-group>
                        <x-form-label for="__usernameLogin" isRequired="true">
                            Username
                        </x-form-label>
                        <x-input-text type="text" name="username" id="__usernameLogin" autocomplete="off" autofocus />
                    </x-form-group>
                    <x-form-group>
                        <x-form-label for="__passwordLogin" isRequired="true">
                            Password
                        </x-form-label>
                        <x-input-text type="password" name="password" id="__passwordLogin" autocomplete="off" />
                    </x-form-group>
                    <div>
                        <x-button type="submit" color="primary">
                            Login
                        </x-button>
                    </div>
                </form>
            </div>
            <div>
                <p class="text-center">
                    Lupa password? <x-link href="#">Reset di sini</x-link>
                </p>
            </div>
        </div>
    </div>
@endsection