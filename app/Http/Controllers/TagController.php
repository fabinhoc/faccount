<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Services\Interfaces\TagServiceInterface;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Http\Request;

class TagController extends Controller
{
    use ApiResponser;

    public $service;

    public function __construct()
    {
        $this->service = app(TagServiceInterface::class);
    }

    public function store(StoreTagRequest $request)
    {
        try {
            $response = $this->service->store($request);
            return $this->success($response);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode() ? $e->getCode() : 422);
        }
    }

    public function update(int $id, UpdateTagRequest $request)
    {
        try {
            $response = $this->service->update($id, $request);
            return $this->success($response);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode() ? $e->getCode() : 422);
        }
    }

    public function paginate(Request $request)
    {
        try {
            $response = $this->service->paginate($request);
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

    public function all()
    {
        try {
            $response = $this->service->all();
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
}
