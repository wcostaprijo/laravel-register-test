<?php

namespace App\Services;

use App\Exceptions\CepException;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Collection;

class CepService
{
    /**
     * Função responsável por buscar o endereço pelo CEP
     *
     * @param string $cep
     * @return Collection
     */
    public function searchAddress(string $cep): Collection
    {
        $response = Curl::to("https://viacep.com.br/ws/{$cep}/json/")
            ->asJson()
            ->returnResponseObject()
            ->get();

        if($response->status == 200) {
            return collect($response->content);
        }

        throw new CepException(
            message: "CEP {$cep} não encontrado",
            status: 404
        );
    }
}
