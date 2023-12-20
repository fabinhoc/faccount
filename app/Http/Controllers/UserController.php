<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Services\Interfaces\UserServiceInterface;
use App\Traits\ApiResponser;
use Exception;

class UserController extends Controller
{
    use ApiResponser;

    public $service;

    public function __construct()
    {
        $this->service = app(UserServiceInterface::class);
    }

    public function update(int $id, UserRequest $request)
    {
        try {
            $response = $this->service->update($id, $request);
            return $this->success($response);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode() ? $e->getCode() : 422);
        }
    }

    public function show(int $id)
    {
        try {
            $response = $this->service->show($id);
            return $this->success($response);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode() ? $e->getCode() : 422);
        }
    }

    public function destroy(int $id)
    {
        try {
            $response = $this->service->destroy($id);
            return $this->success($response);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode() ? $e->getCode() : 422);
        }
    }

    public function changePassword(int $id, ChangePasswordRequest $request)
    {
        try {
            $response = $this->service->changePassword($id, $request);
            return $this->success($response);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode() ? $e->getCode() : 422);
        }
    }
}
