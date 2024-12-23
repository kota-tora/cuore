<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ApiRequest extends FormRequest
{
    public function failedValidation(Validator $validator)
    {
        $data = [
            'status' => 'error',
            'errors' => $validator->errors()->toArray()
        ];

        throw new HttpResponseException(response()->json($data, 422));
    }
}