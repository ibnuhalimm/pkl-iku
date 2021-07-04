@extends('layout.auth')

@section('title')
    Reset Password
@endsection

@section('content')
    <div class="my-10">
        <div class="w-4/5 sm:w-1/2 md:w-2/5 lg:w-1/3 xl:w-1/4 mx-auto">
            <div class="w-1/2 mx-auto text-center">
                <img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }}" class="w-full h-auto">
            </div>
            <div class="text-center mt-3 mb-6">
                <h1 class="text-2xl font-bold">
                    {{ __('Reset Password') }}
                </h1>
            </div>

            @if ($errors->any())
                <x-alert-simple color="red">
                    {{ $errors->first() }}
                </x-alert-simple>
            @endif

            <div class="mb-5">
                <form action="{{ route('password.update') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $request->token }}">
                    <input type="hidden" name="email" value="{{ $request->email }}">
                    <x-form-group>
                        <x-form-label for="__emailLogin" isRequired="true">
                            Username
                        </x-form-label>
                        <x-input-text type="username" name="username" id="__emailLogin" class="bg-gray-100" autocomplete="off" value="{{ $user->username }}" readonly />
                    </x-form-group>
                    <x-form-group>
                        <x-form-label for="__passwordLogin" isRequired="true">
                            {{ __('New Password') }}
                        </x-form-label>
                        <x-input-text type="password" name="password" id="__passwordLogin" autocomplete="off" />
                    </x-form-group>
                    <x-form-group>
                        <x-form-label for="__password_confirmationLogin" isRequired="true">
                            {{ __('Confirm Password') }}
                        </x-form-label>
                        <x-input-text type="password" name="password_confirmation" id="__password_confirmationLogin" autocomplete="off" />
                    </x-form-group>
                    <div>
                        <x-button type="submit" color="primary" class="block w-full">
                            {{ __('Save New Password') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection