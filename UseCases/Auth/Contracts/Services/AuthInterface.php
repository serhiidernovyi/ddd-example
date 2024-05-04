<?php

namespace Auth\Contracts\Services;

use Auth\Contracts\Requests\LoginRequestInterface;

interface AuthInterface
{
    public function login(LoginRequestInterface $resource);
}