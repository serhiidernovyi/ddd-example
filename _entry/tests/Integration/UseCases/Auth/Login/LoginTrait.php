<?php

namespace Tests\Integration\UseCase\Auth\Login;

use App\Http\Requests\Auth\LoginRequest;

trait LoginTrait
{
    public function makeRequest($email = 'email@example.com', $password = 'Password1')
    {
        $request_data = [
            'email' => $email,
            'password' => $password,
        ];

        return new LoginRequest($request_data);
    }
}
