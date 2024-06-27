<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class CepException extends Exception
{
    /**
     * @param string $message
     * @param int $status 400
     * @return void
     */
    function __construct(string $message, private ?int $status = 400)
    {
        $this->message = $message;
    }

    public function report(): void
    { 
        Log::channel('cep')->error("cep: {$this->message}"); 
    }

    public function render(): JsonResponse
    { 
        return response()->json(['message' => $this->message], $this->status); 
    }
}
