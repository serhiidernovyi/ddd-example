<?php

use Auth\Contracts\Requests\LoginRequestInterface;
use Auth\Entities\Models\User;
use Illuminate\Validation\ValidationException;

readonly class Login
{
    public function __construct(
        private User             $user,
        private UserVerification $user_verification
    ) {
    }

    /**
     * @throws ValidationException
     */
    public function loginUser(LoginRequestInterface $request)
    {
        $user = $this->user->where('email', $request->getEmail())->first();

        if (!$this->isValid($user, $request)) {
            throw ValidationException::withMessages([
                'message' => [trans('auth.failed')],
            ]);
        }

        $this->oldTokensRemove($user);

        return $user;
    }

    private function isValid(?User $user, LoginRequestInterface $resource): bool
    {
        return !is_null($user) && $this->user_verification->emailVerify($user) &&
            $this->user_verification->checkPassword($user, $resource);
    }

    /**
     * @param $user
     *
     * @return void
     */
    protected function oldTokensRemove($user): void
    {
        $user->tokens()->delete();
    }
}