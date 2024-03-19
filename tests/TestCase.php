<?php

namespace Tests;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected static $initialized = FALSE;
    private $authorization = null;
    private $request;

    protected function setUp(): void
    {
        parent::setUp();

        if (!self::$initialized) {
            Artisan::call('medlabs:db-refresh');
            $user = (new User())->forceFill([
                'firstname'  => 'Olivia',
                'lastname'   => 'Ryhe',
                'phone'      => '012-3-453',
                'country'    => 'Philippines',
                'state'      => 'Leyte',
                'city'       => 'Tacloban City',
                'email'      => 'olivia@mail.com',
                'password'   =>  Hash::make('password'),
            ]);
            $user->save();
            self::$initialized = TRUE;
        }
    }

    public function httpHeaderRequest()
    {
        if ($this->authorization) {
            return;
        }

        $response = $this->postJson(
            '/oauth/token',
            [
                'grant_type'    => 'client_credentials',
                'client_id'     => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET')
            ]
        );

        $passportCredential  = json_decode($response->baseResponse->content());
        $this->authorization = "{$passportCredential->token_type} {$passportCredential->access_token}";

        return $this->withHeaders([
            'Authorization' => $this->authorization,
            'Content-Type'  => 'application/json'
        ]);
    }
}
