<?php

declare(strict_types=1);

namespace Auth\Services;

use App\Models\User;
use Auth\Contracts\Requests\LoginRequestInterface;
use Auth\Contracts\Services\AuthInterface;
use LoggedDevice;
use Login;
use Illuminate\Foundation\Application;

readonly class AuthService implements AuthInterface
{
    public function __construct(
        private Application  $app,
        private LoggedDevice $device
    ) {
    }

    public function login(LoginRequestInterface $resource): User
    {
        $login = $this->app->make(Login::class);
        $user = $login->loginUser($resource);
        $name_device = $this->device->getDevice();
        $is_mobile = $this->device->isMobile();

        $token = $user->createToken($name_device, $is_mobile)->plainTextToken;
        $user->forceFill([
            'token' => $token,
        ]);

        return $user;
    }
}
