# Med Labs API

This is the Med Labs API project

## System Requirements

-   PHP > 8.1
-   OpenSSL PHP Extension
-   PDO PHP Extension
-   Mbstring PHP Extension
-   Composer
-   Laravel Valet
-   MySQL

## Installation

### Clone Repo

Clone repo using SSH

```
git clone https://github.com/0xCyyy3000/medlabs-api.git
```

### Initialize local setup

Install dependencies

```
composer install
```

### Update `.env` variables

If `.env` doesn't exist, make a copy of `.env.example` and rename the copy to `.env`

Or you can run this command:

```
php -r "file_exists('.env') || copy('.env.example', '.env');"
```

Update MySQL Credentials and database name (Assuming that you already created a database)

```
DB_DATABASE={{DATABASE_NAME}}
DB_USERNAME={{MYSQL_USERNAME}}
DB_PASSWORD={{MYSQL_PASSWORD}}
```

Generate `APP_KEY` value

```
php artisan key:generate
```

### Generate Swagger Docs

```
php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"
php artisan l5-swagger:generate
```

Check docs in `/api/documentation`

### Passport Testing

Run migration to create oauth tables

```
php artisan migrate
```

A Client Credential is needed to access the API using OAuth Token

-   To create a Client Credential you can run:

    ```
    php artisan passport:client
    ```

    and copy values for `CLIENT_ID` and `CLIENT_SECRET` in .`env`

    Update .`env` variables

    ```
    CLIENT_ID=
    CLIENT_SECRET=
    CLIENT_NAME=
    ```

    Then run a Client Credentials Seeder

    ```
    php artisan db:seed --class=ClientCredentialsSeeder
    ```

## Generate OAuth Token

Generate OAuth Token by making a request to **[POST]** `/oauth/token`

```
# POST Request Params

client_id: {{CLIENT_ID}}
client_secret: {{CLIENT_SECRET}}
grant_type: client_credentials
```

### cURL Example:

```
curl --location --request POST '{{APP_URL}}/oauth/token' \
--header 'Content-Type: application/json' \
--data-raw '{
    "grant_type": "client_credentials",
    "client_id": "{{CLIENT_ID}}",
    "client_secret": "{{CLIENT_SECRET}}"
}'
```

### Response:

```
{
    "token_type": "Bearer",
    "expires_in": 31622400,
    "access_token": "*******"
}
```

And with the `access_token` you can request access to the routes that uses the Client Credentials Middleware

```
# GET Request
curl --location --request GET '{{APP_URL}}/hello-world' --header 'Authorization: Bearer {{ACCESS_TOKEN}}'
```