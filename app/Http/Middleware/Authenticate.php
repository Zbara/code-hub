<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        throw new HttpResponseException(response(
            [
                'error' => [
                    'error_code' => 5,
                    'error_msg' => 'User authorization failed: no token passed.',
                    'request_params' => collect($request->all())->map(function ($item, $key) {
                        return [
                            'key' => $key,
                            'value' => $item
                        ];
                    })
                ]
            ], Response::HTTP_UNAUTHORIZED));
    }
}
