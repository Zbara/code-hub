<?php

namespace App\Http\Controllers\Api;

use App\Actions\Auth\AuthAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\AuthRequest;
use App\Http\Resources\Api\User\UserResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @throws AuthenticationException
     */
    public function login(
        AuthRequest $request,
        AuthAction $user
    ) {
        return UserResource::make($user())->additional(['access_token' => $user()->token]);
    }

    public function logout(
        Request $request
    ) {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
