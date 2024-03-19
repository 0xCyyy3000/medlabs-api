<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_post_authenticate_email_endpoint(): void
    {
        $this->httpHeaderRequest()
            ->postJson(
                '/api/v1/authenticate/email',
                [
                    'email'     => 'olivia@mail.com',
                    'password'  => 'password'
                ]
            )
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'id',
                'firstname',
                'lastname',
                'email',
                'email_verified_at',
                'status',
                'role',
                'owner_id',
                'country',
                'state',
                'city',
                'created_at',
                'updated_at',
            ]);
    }

    public function test_invalid_credentials_post_authenticate_email_endpoint()
    {
        $this->httpHeaderRequest()
            ->postJson(
                '/api/v1/authenticate/email',
                ['email' => 'olivia.rhye@gmail.com', 'password' => 'lorem-ipsum']
            )
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_post_sign_up_endpoint()
    {
        $this->httpHeaderRequest()
            ->postJson(
                '/api/v1/sign-up',
                [
                    'firstname'             => 'Adam',
                    'lastname'              => 'Clay',
                    'phone'                 => '012-3-453',
                    'country'               => 'Philippines',
                    'state'                 => 'Leyte',
                    'city'                  => 'Tacloban City',
                    'email'                 => 'adam.clay@gmail.com',
                    'password'              => 'password',
                    'password_confirmation' => 'password'
                ]
            )
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'id',
                'firstname',
                'lastname',
                'email',
                'email_verified_at',
                'status',
                'role',
                'owner_id',
                'country',
                'state',
                'city',
                'created_at',
                'updated_at',
            ]);
    }
}
