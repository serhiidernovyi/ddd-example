<?php

namespace Tests\Integration\UseCase\Auth\Login;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use LoginTrait;
    use RefreshDatabase;

    /**
     * @feature Auth
     * @scenario Login
     * @case Successfully login
     *
     * @test
     */
    public function loginUser_success()
    {
        // GIVEN
        $right_email = 'email@example.com';
        $right_password = 'Password1';
        $user = $this->createUser($right_email);
        $request = $this->makeRequest($right_email, $right_password);

        $tested_use_case = $this->app->make(Auth::class);

        // WHEN
        $token = $tested_use_case->login($request);

        // THEN
        $this->assertCount(1, $user->tokens()->get());
        $this->assertNotNull($token);
    }
}
