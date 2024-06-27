@extends('layouts.app', ['page' => 'Login'])

@section('content')
<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto">
        <a href="/register" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            {{ config('app.name') }}
        </a>
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-3xl xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center">
                    Crie sua conta
                </h1>
                <form class="space-y-4 md:space-y-6" id="registerForm">
                    @csrf
                    <x-form.input label="Nome:" type="text" name="name" placeholder="Nome completo" required="true" />

                    <div class="grid grid-cols-1 gap-0 md:grid-cols-3 md:gap-4">
                        <x-form.input label="CEP:" type="text" name="cep" placeholder="XX XXX-XXX" required="true" />
                        <x-form.input custom-class="col-span-2 mt-3 md:mt-0" label="Endereço:" type="text" name="street" placeholder="Rua central" disabled="true" />
                    </div>

                    <x-form.input label="Bairro:" type="text" name="neighborhood" placeholder="Centro" disabled="true" />
                    <div class="grid md:grid-cols-2 md:gap-4 grid-cols-1 gap-0">
                        <x-form.input label="Cidade:" type="text" name="city" placeholder="Goiânia" disabled="true" />
                        <x-form.input custom-class="mt-3 md:mt-0" label="Estado:" type="text" name="state" placeholder="GO" disabled="true" />
                    </div>

                    <div class="grid md:grid-cols-2 md:gap-4 grid-cols-1 gap-0">
                        <x-form.input label="Complemento:" type="text" name="complement" placeholder="Q 01 L0 1" />
                        <x-form.input custom-class="mt-3 md:mt-0" label="Número:" type="number" name="number" placeholder="01" />
                    </div>

                    <x-form.input label="E-mail:" type="email" name="email" placeholder="exemplo@teste.com" required="true" />
                    <div class="grid grid-cols-1 gap-0 md:grid-cols-2 md:gap-4">
                        <x-form.input label="Senha:" type="password" name="password" placeholder="******" required="true" />
                        <x-form.input custom-class="mt-3 md:mt-0" label="Confirmar Senha:" type="password" name="password_confirmation" placeholder="******" required="true" />
                    </div>
                    
                    <div class="pt-4 grid md:grid-cols-3 grid-cols-1">
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400 mt-3 col-span-2">
                            Já possui conta? 
                            <a href="/login" class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                                Acessar conta
                            </a>
                        </p>

                        <button class="mt-3 md:mt-0 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Criar Conta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom-js')
<script src="/js/register.js"></script>
@endsection