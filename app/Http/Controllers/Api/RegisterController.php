<?php

namespace App\Http\Controllers\Api;

use App\Contracts\RegisterUserInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Register\RegisterUserRequest;
use App\Http\Requests\Api\Register\ResendEmailRequest;
use App\Http\Resources\Api\User\UserResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @name RegisterController
 */
class RegisterController extends Controller
{
    public function __construct(
        private readonly RegisterUserInterface $service,
    ) {
    }

    public function register(
        RegisterUserRequest $request
    ): JsonResource {
        return UserResource::make(
            $this->service->register($request->validated(), $request->ip(), $request->userAgent())
        );
    }

    public function sendNewCode(
        ResendEmailRequest $request
    ) {
       return $this->service->reSend($request->input('email'));
    }

    /**
     * @throws AuthenticationException
     */
    public function verify(
        Request $request,
        int $user_id
    ) {
        if (! $request->hasValidSignature()) {
            throw new AuthenticationException('Invalid verification link');
        }

        return $this->service->verify($user_id);
    }
}
