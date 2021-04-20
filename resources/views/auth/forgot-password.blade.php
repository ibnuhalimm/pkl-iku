@extends('layout.auth')

@section('title')
    Forgot Password
@endsection

@section('content')
    <div class="my-20">
        <div class="w-4/5 sm:w-1/2 md:w-2/5 lg:w-1/3 xl:w-1/4 mx-auto">
            <div class="w-1/2 mx-auto text-center">
                <img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }}" class="w-full h-auto">
            </div>
            <div class="text-center mt-3 mb-6">
                <h1 class="text-2xl font-bold">
                    {{ __('Forgot Password') }}
                </h1>
            </div>

            @if ($errors->any())
                <x-alert-simple color="red">
                    {{ $errors->first() }}
                </x-alert-simple>
            @endif

            @if (session('status'))
                <x-alert-simple color="green">
                    {{ session('status') }}
                </x-alert-simple>
            @endif

            <div class="mb-5">
                <form action="{{ route('password.email') }}" method="post">
                    {{ csrf_field() }}
                    <x-form-group>
                        <x-form-label for="__emailForgotPassword" isRequired="true">
                            Email
                        </x-form-label>
                        <x-input-text type="email" name="email" id="__emailForgotPassword" autocomplete="off" autofocus />
                    </x-form-group>
                    <div>
                        <x-button type="submit" color="primary">
                            {{ __('Send Reset Link') }}
                        </x-button>
                    </div>
                </form>
            </div>
            <div>
                <p class="text-center">
                    <x-link href="{{ route('login') }}">
                        {{ __('Back to Login') }}
                    </x-link>
                </p>
            </div>
        </div>
    </div>
@endsection