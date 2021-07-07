@extends('layout.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <x-card.card-default class="mb-6">
        <x-card.header>
            <x-card.title>
                {{ __('Dashboard') }}
            </x-card.title>
        </x-card.header>
        <x-card.body>
            <div class="px-6 pb-6">
                Hai, selamat datang {{ Auth::user()->name }}.
            </div>
        </x-card.body>
    </x-card.card-default>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="w-full rounded-lg shadow-md bg-white flex flex-row items-center justify-between px-5 py-6">
            <div class="w-1/3 pr-6">
                <div class="w-full flex items-center justify-center bg-iku-primary bg-opacity-10 p-4 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-10 h-10 text-blue-500 bi bi-bookmark-star" viewBox="0 0 16 16">
                        <path d="M7.84 4.1a.178.178 0 0 1 .32 0l.634 1.285a.178.178 0 0 0 .134.098l1.42.206c.145.021.204.2.098.303L9.42 6.993a.178.178 0 0 0-.051.158l.242 1.414a.178.178 0 0 1-.258.187l-1.27-.668a.178.178 0 0 0-.165 0l-1.27.668a.178.178 0 0 1-.257-.187l.242-1.414a.178.178 0 0 0-.05-.158l-1.03-1.001a.178.178 0 0 1 .098-.303l1.42-.206a.178.178 0 0 0 .134-.098L7.84 4.1z"/>
                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                    </svg>
                </div>
            </div>
            <div class="w-2/3">
                <div>
                    <span class="text-lg text-gray-700">
                        Fakultas / Prodi
                    </span>
                </div>
                <div>
                    <span class="font-bold text-xl text-gray-900">
                        {{ number_format($facultiesCount, 0, ',', '.') }}
                            <span class="text-gray-500">/</span>
                        {{ number_format($studyProgramsCount, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>
        <div class="w-full rounded-lg shadow-md bg-white flex flex-row items-center justify-between px-5 py-6">
            <div class="w-1/3 pr-6">
                <div class="w-full flex items-center justify-center bg-iku-primary bg-opacity-10 p-4 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-10 h-10 text-blue-500 bi bi-people" viewBox="0 0 16 16">
                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                    </svg>
                </div>
            </div>
            <div class="w-2/3">
                <div>
                    <span class="text-lg text-gray-700">
                        Mahasiswa
                    </span>
                </div>
                <div>
                    <span class="font-bold text-xl text-gray-900">
                        {{ number_format($studentsCount, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>
        <div class="w-full rounded-lg shadow-md bg-white flex flex-row items-center justify-between px-5 py-6">
            <div class="w-1/3 pr-6">
                <div class="w-full flex items-center justify-center bg-iku-primary bg-opacity-10 p-4 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-10 h-10 text-blue-500 bi bi-building" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z"/>
                        <path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z"/>
                    </svg>
                </div>
            </div>
            <div class="w-2/3">
                <div>
                    <span class="text-lg text-gray-700">
                        Perusahaan
                    </span>
                </div>
                <div>
                    <span class="font-bold text-xl text-gray-900">
                        {{ number_format($companiesCount, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection