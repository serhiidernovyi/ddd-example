<?php

namespace Auth;

use Auth\Contracts\Requests\LoginRequestInterface;
use Auth\Contracts\Services\AuthInterface;
use DomainServiceFactory;

readonly class Auth
{
    public function __construct(
        private DomainServiceFactory $domainServiceFactory
    ) {
    }

    public function login(LoginRequestInterface $resource)
    {
        /** @var AuthInterface $authService */
        $authService = $this->domainServiceFactory->create(AuthInterface::class);

        return $authService->login($resource);
    }

}