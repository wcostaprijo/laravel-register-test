@extends('layouts.app', ['page' => 'Login'])

@section('content')
<header>
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="/home" class="flex items-center">
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{ config('app.name') }}</span>
            </a>
            <div class="flex items-center lg:order-2">
                <form id="logoutForm">
                    @csrf
                    <button class="grid grid-cols-2 text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                        Sair
                        <svg class="ml-1 w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </nav>
</header>

<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        <!-- Start coding here -->
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">
                    Usuários cadastrados
                </span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nome</th>
                            <th scope="col" class="px-4 py-3">E-mail</th>
                            <th scope="col" class="px-4 py-3">Endereço</th>
                            <th scope="col" class="px-4 py-3">Cidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="border-b dark:border-gray-700">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ ucwords(mb_strtolower($user->name)) }}
                                </th>
                                <td class="px-4 py-3">{{ $user->email }}</td>
                                <td class="px-4 py-3">
                                    {{ $user?->address?->street }}
                                    {{ !empty($user?->address?->number) ? ', '.$user?->address?->number : '' }}
                                    {{ !empty($user?->address?->complement) ? ', '.$user?->address?->complement : '' }},
                                    {{ ucwords(mb_strtolower($user?->address?->neighborhood)) }}
                                </td>
                                <td class="px-4 py-3">{{ ucwords(mb_strtolower($user?->address?->city)) }} - {{ $user?->address?->state }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </section>
@endsection

@section('custom-js')
<script src="/js/home.js"></script>
@endsection
