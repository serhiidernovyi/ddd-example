<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Auth\Contracts\Requests\LoginRequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest implements LoginRequestInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [
                'min:5',
                'required',
                'email',
                'max:255',
                'regex:/(.+)@(.+)\\.(.+)/i',
            ],
            'password' => 'max:255|required|string',
        ];
    }

    public function getEmail()
    {
        return $this->input('email');
    }

    public function getUserPassword()
    {
        return $this->input('password');
    }
}
