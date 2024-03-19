<?php

namespace Tests\Feature;

use Tests\TestCase as TestBase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

class UserTest extends TestBase
{
    /**
     * A basic feature test example.
     */
    public function test_get_users_endpoint(): void
    {
        $this->httpHeaderRequest()
            ->get('/api/v1/users')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'users' => [
                    '*' => [
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
                    ]
                ],
                'meta'  => []
            ]);
    }

    public function test_post_users_endpoint()
    {
        $this->httpHeaderRequest()
            ->postJson(
                '/api/v1/users',
                [
                    'firstname'             => 'Owen',
                    'lastname'              => 'Chase',
                    'phone'                 => '012-3-453',
                    'country'               => 'Philippines',
                    'state'                 => 'Leyte',
                    'city'                  => 'Tacloban City',
                    'email'                 => 'owen.chase@gmail.com',
                    'password'              => 'password',
                    'password_confirmation' => 'password'
                ]
            )
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonPath('firstname', 'Owen')
            ->assertJsonPath('lastname', 'Chase')
            ->assertJsonPath('email', 'owen.chase@gmail.com');
    }

    public function test_get_users_by_id_endpoint()
    {
        $this->httpHeaderRequest()
            ->getJson('/api/v1/users/1')
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

    public function test_patch_users_by_id_endpoint()
    {
        $this->httpHeaderRequest()
            ->patchJson(
                '/api/v1/users/1',
                ['firstname' => 'John']
            )
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonPath('firstname', 'John')
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

    public function  test_get_users_by_id_endpoint_not_found()
    {
        $this->httpHeaderRequest()
            ->get('/api/v1/users/9999')
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
