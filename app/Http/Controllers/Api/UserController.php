<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser()
    {
        return UserResource::make(auth()->user());
    }
}
