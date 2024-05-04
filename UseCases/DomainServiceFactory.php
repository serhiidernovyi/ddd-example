<?php

use Auth\Contracts\Services\AuthInterface;
use Auth\Services\AuthService;
use Illuminate\Log\Logger;
use Illuminate\Foundation\Application;
use Illuminate\Support\Arr;

class DomainServiceFactory
{
    protected array $bindings = [
        AuthInterface::class => AuthService::class,
    ];

    /**
     * DomainServiceFactory constructor.
     *
     * @param Application $app
     * @param Logger $logger
     */
    public function __construct(
        private readonly Application $app,
        private readonly Logger $logger,
        private readonly Arr $arr,
    ) {
    }

    /**
     * @template T
     *
     * @param class-string<T> $interface
     *
     * @return T
     */
    public function create(string $interface, ?array $params = [])
    {
        $service_class = $this->arr->get($this->bindings, $interface);

        try {
            return $this->app->make($service_class, $params);
        } catch (\Throwable $throwable) {
            $this->logger->error($throwable->getMessage());

            throw new DomainServiceException($interface, $params, $throwable);
        }
    }
}