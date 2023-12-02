<?php

namespace App\Services;

use Exception;
use Throwable;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use App\Services\Interfaces\AuthenticationServiceInterface;

class AuthenticationService implements AuthenticationServiceInterface
{
    private $repository;

    public function __construct()
    {
        $this->repository = app(UserRepositoryInterface::class);
    }

    public function register(RegisterUserRequest $request): Array
    {
        try {
            Log::info('Registering user', ['request' => $request->only('email')]);
            $attributes = $request->only(['name', 'email', 'password']);
            $attributes['password'] = Hash::make($attributes['password']);
            $user = $this->repository->create($attributes);
            event(new Registered($user));
            $accessToken = $user->createToken('authToken')->plainTextToken;
            return ['user' => $user, 'access_token' => $accessToken];
        } catch (Throwable $exception) {
            throw $exception;
        }
    }

    public function login(LoginRequest $request): Array
    {
        try {
            $user = $this->repository->findByEmail($request->email);
            if (!$user) {
                throw new Exception(__('apiResponses.UserNotFound'), 400);
            }
            if (!$user->hasVerifiedEmail()) {
                throw new Exception(__('apiResponses.emailNotVerified'), 400);
            }
            if (!Auth::attempt($request->only(['email', 'password']))) {
                throw new Exception(__('apiResponses.authenticationFailed'), 400);
            }
            $accessToken = $user->createToken('authToken')->plainTextToken;
            return ['user' => $user, 'access_token' => $accessToken];
        } catch (Throwable $exception) {
            throw $exception;
        }
    }

    public function reset(ResetPasswordRequest $request)
    {
        try {
            return Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function (User $user, string $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));
                    $user->markEmailAsVerified();
                    $user->save();
                    event(new PasswordReset($user));
                }
            );
        } catch (Throwable $exception) {
            throw $exception;
        }
    }
}
