<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;


class ApiRequest extends FormRequest
{
    public function errors($errors)
    {
        return [
            'data' => null,
            'errors' => $errors
        ];
    }
    public function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(
            $this->errors($errors),
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY
        ));
    }
}
