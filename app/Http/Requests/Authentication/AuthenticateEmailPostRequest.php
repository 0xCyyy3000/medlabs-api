<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class AuthenticateEmailPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    #[OA\Schema(
        schema: 'SignIn',
        required: [
            'email',
            'password',
        ],
        properties: [
            new OA\Property(
                property: 'email',
                type: 'string',
                format: 'email',
                example: 'john@example.com',
                description: 'Unique email'
            ),
            new OA\Property(
                property: 'password',
                type: 'string',
                example: '123456'
            ),
        ]
    )]

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'     => ['required', 'email'],
            'password'  => ['required', 'string']
        ];
    }
}
