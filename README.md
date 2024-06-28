# Laravel Simple Register

## Instalação

1. Clone o repositório:
    ```sh
    git clone git@github.com:wcostaprijo/laravel-register-test.git
    cd laravel-register-test
    ```

2. Instale as dependências:
    ```sh
    composer install
    ```

3. Configure o arquivo `.env`:
    ```sh
    cp .env.example .env
    php artisan key:generate
    ```

4. Configure o banco de dados no arquivo `.env` e execute as migrações:
    ```sh
    php artisan migrate
    ```

5. Inicie o servidor:
    ```sh
    php artisan serve
    ```

## Funcionalidades

- Cadastro de Usuários
- Login de Usuários
- Recuperação de Senha
- Listagem de Usuários na Página Inicial

## Autenticação via Sanctum

O projeto utiliza Laravel Sanctum para autenticação via tokens de API. Para mais informações, consulte a [documentação do Sanctum](https://laravel.com/docs/8.x/sanctum).

## Integração com API de CEP

A integração com a API de CEP é feita através do `CepService`, que utiliza a API pública do [ViaCEP](https://viacep.com.br/) para buscar informações de endereço a partir do CEP.
