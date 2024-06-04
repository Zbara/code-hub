<?php

namespace App\Contracts;

interface RegisterUserInterface
{
    public function register(array $input, string $ip, string $userAgent);

    public function verify(int|string $userId);

    public function reSend(string $email);
}
