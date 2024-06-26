<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

final class AuthAction
{
    /**
     * @throws AuthenticationException
     */
    public function __invoke(): User
    {
        if (! Auth::attempt(request()->only('email', 'password'))) {
            throw new AuthenticationException('Invalid credentials');
        }

        Auth::user()->token = Auth::user()->createToken('auth')->plainTextToken;

        return Auth::user();
    }
}
