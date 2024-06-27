<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use App\Exceptions\CepException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(private CepService $cepService)
    { }

    public function store(Request $request): User
    {
        try {
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

            if (Auth::attempt($request->only('email', 'password'))) {
                $request->session()->regenerate();
                return response()->json(['success' => true], 200);
            }

            return $user->load('address');
        } catch (\Throwable $th) {
            throw new CepException(
                message: $th->getMessage()
            );
        }
    }
}

