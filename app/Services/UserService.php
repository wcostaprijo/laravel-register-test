<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(private CepService $cepService)
    { }

    public function store(Request $request): User
    {
        $address = $this->cepService->searchAddress(cep: $request->cep);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->address()->create([
            'complement' => $request->complement,
            'number' => $request->number,
            'cep' => $address->cep,
            'street' => $address->logradouro,
            'neighborhood' => $address->bairro,
            'city' => $address->localidade,
            'state' => $address->uf,
        ]);

        return $user->load('address');
    }
}

