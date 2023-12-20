<?php

namespace App\Services;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Throwable;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    private $repository;

    public function __construct()
    {
        $this->repository = app(UserRepositoryInterface::class);
    }


    public function show(int $id): ?User
    {
        try {
            return $this->repository->findOrFail($id);
        } catch (Throwable $exception) {
            throw $exception;
        }
    }

    public function destroy(int $id): int
    {
        try {
            return $this->repository->destroy($id);
        } catch (Throwable $exception) {
            throw $exception;
        }
    }

    public function update(int $id, UserRequest $request): int
    {
        try {
            return $this->repository->update($id, $request->all());
        } catch (Throwable $exception) {
            throw $exception;
        }
    }

    public function changePassword(int $id, ChangePasswordRequest $request): int
    {
        try {
            $attributes = $request->only(['password']);
            $attributes['password'] = Hash::make($attributes['password']);
            return $this->repository->update($id, $attributes);
        } catch (Throwable $exception) {
            throw $exception;
        }
    }
}
