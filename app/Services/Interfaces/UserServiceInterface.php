<?php

namespace App\Services\Interfaces;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;

interface UserServiceInterface
{
    public function update(int $id, UserRequest $request): int;
    public function show(int $id): ?User;
    public function destroy(int $id): int;
    public function changePassword(int $id, ChangePasswordRequest $request): int;
}
