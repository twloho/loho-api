<?php

namespace App\Association\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class MemberException extends Exception
{
    private $errors;

    public function __construct($errors) {
        parent::__construct();

        $this->errors = $errors;
    }

    public function response()
    {
        return new JsonResponse([
            'errors' => $this->errors,
        ], 400);
    }
}
