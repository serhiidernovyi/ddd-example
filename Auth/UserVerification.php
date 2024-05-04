<?php

use Auth\Contracts\Requests\LoginRequestInterface;
use Auth\Entities\Models\User;
use Illuminate\Support\Facades\Hash;

class UserVerification
{
    private Hash $hash;

    public function __construct(Hash $hash)
    {
        $this->hash = $hash;
    }

    public function emailVerify(User $user): bool
    {
        if (!$user->hasVerifiedEmail()) {
            return false;
        }

        return true;
    }

    public function checkPassword(User $user, LoginRequestInterface $resource): bool
    {
        if (!$this->hash::check($resource->getUserPassword(), $user->password)) {
            return false;
        }

        return true;
    }
}