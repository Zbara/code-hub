<?php

namespace App\Services;

use App\Contracts\RegisterUserInterface;
use App\Enums\UserAction;
use App\Jobs\SendRegistrationEmailJob;
use App\Models\User;
use League\CommonMark\Exception\AlreadyInitializedException;

final class RegisterUserService implements RegisterUserInterface
{
    public function register(
        array $input,
        string $ip,
        string $userAgent
    ): User {
        $user = User::query()->create(array_merge([
            'password' => $input['password'],
        ], $input));

        $user->userLogs()->create([
            'action' => UserAction::CREATED,
            'ip_address' => $ip,
            'user_agent' => $userAgent,
        ]);

        SendRegistrationEmailJob::dispatch($user);

        return $user;
    }

    /**
     * @throws AlreadyInitializedException
     */
    public function reSend(
        string $email
    ): array
    {
        $user = User::whereEmail($email)->firstOrFail();

        if ($user->hasVerifiedEmail()) {
            throw new AlreadyInitializedException;
        }

        SendRegistrationEmailJob::dispatch($user);

        return [
            'message' => 'Email re-sent successfully',
        ];
    }

    public function verify(
        int|string $userId
    ): array
    {
        $user = User::findOrFail($userId);

        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return [
            'message' => 'Email verified successfully',
        ];
    }
}
