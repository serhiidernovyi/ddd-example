<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected User $user;

    public function createUser($email = 'email@example.com')
    {
        $this->user = User::factory()->state([
            'email' => $email,
            'name' => 'John'
        ])->create();

        return $this->user;
    }
}
