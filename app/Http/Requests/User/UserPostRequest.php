<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class UserPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    #[OA\Schema(
        schema: 'UserPostRequest',
        required: ['name', 'email', 'password', 'password_confirmation'],
        properties: [
            new OA\Property(
                property: 'name',
                type: 'string',
                example: 'John Doe'
            ),
            new OA\Property(
                property: 'email',
                type: 'string',
                format: 'email',
                example: 'john@example.com'
            ),
            new OA\Property(
                property: 'password',
                type: 'string',
                example: '123456'
            ),
            new OA\Property(
                property: 'password_confirmation',
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
            'name' => ['required', 'string'],
            'email' => ['required', 'unique:users,email,except,id'],
            'password' => ['required', 'string', 'confirmed'],
        ];
    }
}
