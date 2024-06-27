<?php

namespace App\Services;

use stdClass;
use Ixudra\Curl\Facades\Curl;
use App\Exceptions\CepException;

class CepService
{
    /**
     * Função responsável por buscar o endereço pelo CEP
     *
     * @param string $cep
     * @return stdClass
     */
    public function searchAddress(string $cep): stdClass
    {
        $response = Curl::to("https://viacep.com.br/ws/{$cep}/json/")
            ->asJson()
            ->returnResponseObject()
            ->get();

        if($response->status == 200) {
            return json_decode(json_encode($response->content));
        }

        throw new CepException(
            message: "CEP {$cep} não encontrado",
            status: 404
        );
    }
}
