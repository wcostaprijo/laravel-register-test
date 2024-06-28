@extends('layouts.app', ['page' => 'Recuperar Senha'])

@section('content')
<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto">
        <a href="/password/reset" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            {{ config('app.name') }}
        </a>
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center">
                    Recuperar Senha
                </h1>
                <form class="space-y-4 md:space-y-6" id="resetForm">
                    @csrf

                    <x-form.input label="E-mail:" type="email" name="email" placeholder="exemplo@teste.com" required="true" />
                    
                    <button class="w-full mt-3 md:mt-0 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Recuperar Senha
                    </button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400 mt-3">
                        Já possui conta? 
                        <a href="/login" class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                            Acessar conta
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom-js')
<script src="/js/reset-password.js"></script>
@endsection
