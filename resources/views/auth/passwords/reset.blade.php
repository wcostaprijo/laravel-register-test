@extends('layouts.app', ['page' => 'Criar Nova senha'])

@section('content')
<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            {{ config('app.name') }}
        </a>
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center">
                    Criar Nova senha
                </h1>
                <form class="space-y-4 md:space-y-6" id="updateForm">
                    @csrf
                    <x-form.input label="" type="hidden" name="token" placeholder="" required="true" value="{{ $token }}" />

                    <x-form.input label="E-mail:" type="email" name="email" placeholder="exemplo@teste.com" required="true" value="{{ request()->email ?? '' }}" />
                    <x-form.input label="Nova Senha:" type="password" name="password" placeholder="******" required="true" />
                    <x-form.input custom-class="mt-3 md:mt-0" label="Confirmar Nova Senha:" type="password" name="password_confirmation" placeholder="******" required="true" />
                    
                    <button class="w-full mt-3 md:mt-0 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Criar Nova senha
                    </button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400 mt-3">
                        <a href="/login" class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                            Cancelar
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom-js')
<script src="/js/update-password.js"></script>
@endsection
