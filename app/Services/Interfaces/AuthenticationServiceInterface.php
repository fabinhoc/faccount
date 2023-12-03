<?php

namespace App\Services\Interfaces;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\ResetPasswordRequest;

interface AuthenticationServiceInterface
{
    /**
     * @param RegisterUserRequest $request
     * @return Array
    */
    public function register(RegisterUserRequest $request): Array;

    /**
     * @param LoginRequest $request
     * @return Array
     */
    public function login(LoginRequest $request): Array;

    public function reset(ResetPasswordRequest $request);
}
