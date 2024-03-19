<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

class AuthenticateSignUpPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    #[OA\Schema(
        schema: 'SignUp',
        required: [
            'firstname',
            'lastname',
            'phone',
            'email',
            'country',
            'state',
            'city',
            'password',
            'password_confirmation',
        ],
        properties: [
            new OA\Property(
                property: 'firstname',
                type: 'string',
                example: 'John',
                description: 'First name of user',
            ),
            new OA\Property(
                property: 'lastname',
                type: 'string',
                example: 'Doe',
                description: 'Last name of user'
            ),
            new OA\Property(
                property: 'phone',
                type: 'string',
                example: '1-984-993-4778',
                description: 'Last name of user'
            ),
            new OA\Property(
                property: 'country',
                type: 'string',
                example: 'Philippines',
                description: 'Last name of user'
            ),
            new OA\Property(
                property: 'state',
                type: 'string',
                example: 'Leyte',
                description: 'State or province'
            ),
            new OA\Property(
                property: 'city',
                type: 'string',
                example: 'Tacloban',
                description: 'City or municipality'
            ),
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
            new OA\Property(
                property: 'password_confirmation',
                type: 'string',
                example: '123456'
            ),
            new OA\Property(
                property: 'owner_id',
                type: 'integer',
                example: null,
                description: 'The owner (user_id) of this account'
            ),
            new OA\Property(
                property: 'role',
                type: 'integer',
                example: 1,
                description: 'Role'
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
            'firstname' => ['required', 'string'],
            'lastname'  => ['required', 'string'],
            'phone'     => ['sometimes', 'required', 'string'],
            'country'   => ['required', 'string'],
            'state'     => ['required', 'string'],
            'city'      => ['required', 'string'],
            'email'     => ['required', 'email', 'unique:users,email,except,id'],
            'password'  => ['required', 'string', 'confirmed'],
            'owner_id'  => ['sometimes', 'required', 'integer'],
            'role'      => ['sometimes', 'required', 'integer']
        ];
    }
}
