<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\Interfaces\AuthenticationServiceInterface;
use App\Traits\ApiResponser;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class AuthenticationController extends Controller
{
    use ApiResponser;

    private $service;

    public function __construct()
    {
        $this->service = app(AuthenticationServiceInterface::class);
    }

    public function register(RegisterUserRequest $request)
    {
        try {
            $response = $this->service->register($request);
            return $this->success($response);
        } catch (Exception $e) {
            Log::error($e->getMessage(), ['exception' => $e ]);
            return $this->error($e->getMessage(), 500);
        }
    }

    public function verify(EmailVerificationRequest $request)
    {
        try {
            if ($request->user()->hasVerifiedEmail()) return $this->success([], __('apiResponses.emailAlreadyVerified'));
            if (!$request->hasValidSignature()) throw new Exception(__('apiResponses.invalidUrl'), 400);
            if ($request->user()->markEmailAsVerified()) {
                event(new Verified($request->user()));
                return $this->success([], __('apiResponses.emailVerified'));
            }
        } catch (Exception $e) {
            Log::error($e->getMessage(), ['exception' => $e ]);
            return $this->error($e->getMessage(), $e->getCode() ? $e->getCode() : 422);
        }
    }

    public function verification(Request $request)
    {
        try {
            if ($request->user()->hasVerifiedEmail()) return $this->success([], __('apiResponses.emailAlreadyVerified'));
            $response = $request->user()->sendEmailVerificationNotification();
            return $this->success([], $response);
        } catch (Exception $e) {
            Log::error($e->getMessage(), ['exception' => $e ]);
            return $this->error($e->getMessage(), $e->getCode() ? $e->getCode() : 422);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $response = $this->service->login($request);
            return $this->success($response);
        } catch (Exception $e) {
            Log::error($e->getMessage(), ['exception' => $e ]);
            return $this->error($e->getMessage(), $e->getCode() ? $e->getCode() : 422);
        }
    }

    public function forgot(ForgotPasswordRequest $request)
    {
        try {
            $response = Password::sendResetLink($request->only('email'));
            if ($response == Password::RESET_LINK_SENT) return $this->success([], __($response));
            throw new ValidationException(__($response));
        } catch (Exception $e) {
            Log::error($e->getMessage(), ['exception' => $e ]);
            return $this->error($e->getMessage(), $e->getCode() ? $e->getCode() : 422);
        }
    }

    public function reset(ResetPasswordRequest $request)
    {
        try {
            $status = $this->service->reset($request);
            return $status === Password::PASSWORD_RESET
                        ? $this->success([], __($status))
                        : throw new ValidationException(__($status));
        } catch (Exception $e) {
            Log::error($e->getMessage(), ['exception' => $e ]);
            return $this->error($e->getMessage(), $e->getCode() ? $e->getCode() : 422);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return $this->success(null, __('apiResponses.tokenRevoked'));
        } catch (Exception $e) {
            Log::error($e->getMessage(), ['exception' => $e ]);
            return $this->error($e->getMessage(), $e->getCode() ? $e->getCode() : 422);
        }
    }
}
