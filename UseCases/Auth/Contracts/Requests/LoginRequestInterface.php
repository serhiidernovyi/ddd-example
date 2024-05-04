<?php

namespace Auth\Contracts\Requests;

interface LoginRequestInterface
{
    public function getEmail();
    public function getUserPassword();
}