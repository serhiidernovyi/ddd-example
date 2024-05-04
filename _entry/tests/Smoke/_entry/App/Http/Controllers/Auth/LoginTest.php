<?php

namespace Tests\Smoke\_entry\App\Http\Controllers\Auth;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use function route;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseTransactions;
    use LoginTrait;

    #[Test] public function login_success_response201()
    {
        // GIVEN
        $credentials = $this->createCredentials();
        $this->createUser();

        // WHEN
        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->json('post', route('login'), $credentials);

        // THEN
        $this->assertEquals(201, $response->getStatusCode());
    }
}
