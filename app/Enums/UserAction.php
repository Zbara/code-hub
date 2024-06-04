<?php

namespace App\Enums;

enum UserAction: int
{
    case CREATED = 1;
    case LOGIN = 2;
    case LOGOUT = 3;
    case UPDATE = 4;
    const VERIFIED = 5;
}
