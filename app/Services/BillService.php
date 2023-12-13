<?php

namespace App\Services;

use App\Http\Requests\StoreBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Models\Bill;
use App\Repositories\Interfaces\BillRepositoryInterface;
use Throwable;
use App\Services\Interfaces\BillServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class BillService implements BillServiceInterface
{
    private $repository;

    public function __construct()
    {
        $this->repository = app(BillRepositoryInterface::class);
    }

    public function paginate(Request $request): LengthAwarePaginator
    {
        try {
            return $this->repository->paginate($request);
        } catch (Throwable $exception) {
            throw $exception;
        }
    }

    public function all(): Collection
    {
        try {
            return $this->repository->all();
        } catch (Throwable $exception) {
            throw $exception;
        }
    }

    public function show(int $id): ?Bill
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

    public function store(StoreBillRequest $request): ?Bill
    {
        try {
            $attributes = $request->all();
            $attributes = array_merge($attributes, ['user_id' => auth()->user()->id]);
            return $this->repository->create($attributes);
        } catch (Throwable $exception) {
            throw $exception;
        }
    }

    public function update(int $id, UpdateBillRequest $request): int
    {
        try {
            return $this->repository->update($id, $request->all());
        } catch (Throwable $exception) {
            throw $exception;
        }
    }
}
