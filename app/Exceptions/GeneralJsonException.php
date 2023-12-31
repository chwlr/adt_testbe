<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class GeneralJsonException extends Exception
{
    public function render($request): JsonResponse
    {
        return new JsonResponse([
           'errors' => [
               'message' => $this->getMessage()
           ]
        ], $this->getCode());
    }
}
