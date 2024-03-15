<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Passport\Client;

class ClientCredentialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!env('CLIENT_ID') || !env('CLIENT_SECRET')) {
            throw new \Exception("Set CLIENT_ID and CLIENT_SECRET in .env file", 1);
        }

        try {
            $client = (new Client())->forceFill([
                'id'                     => env('CLIENT_ID'),
                'user_id'                => 0,
                'name'                   => env('CLIENT_NAME'),
                'secret'                 => env('CLIENT_SECRET'),
                'redirect'               => '',
                'personal_access_client' => 0,
                'password_client'        => 0,
                'revoked'                => 0
            ]);

            $client->save();
        } catch (\Throwable $e) {
            echo $e->getMessage();
            exit;
        }

        echo "Med Labs Client Seeded!\n";
    }
}
