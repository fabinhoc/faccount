<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotebookRequest;
use App\Http\Requests\UpdateNotebookRequest;
use App\Services\Interfaces\NotebookServiceInterface;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Http\Request;

class NotebookController extends Controller
{
    use ApiResponser;

    public $service;

    public function __construct()
    {
        $this->service = app(NotebookServiceInterface::class);
    }

    public function store(StoreNotebookRequest $request)
    {
        try {
            $response = $this->service->store($request);
            return $this->success($response);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode() ? $e->getCode() : 422);
        }
    }

    public function update(int $id, UpdateNotebookRequest $request)
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
