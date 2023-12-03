<?php

namespace App\Services;

use App\Http\Requests\StoreNotebookRequest;
use App\Http\Requests\UpdateNotebookRequest;
use App\Models\Notebook;
use Throwable;
use App\Repositories\Interfaces\NotebookRepositoryInterface;
use App\Services\Interfaces\NotebookServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class NotebookService implements NotebookServiceInterface
{
    private $repository;

    public function __construct()
    {
        $this->repository = app(NotebookRepositoryInterface::class);
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

    public function show(int $id): ?Notebook
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

    public function store(StoreNotebookRequest $request): ?Notebook
    {
        try {
            $attributes = $request->all();
            $attributes = array_merge($attributes, ['user_id' => auth()->user()->id]);
            return $this->repository->create($attributes);
        } catch (Throwable $exception) {
            throw $exception;
        }
    }

    public function update(int $id, UpdateNotebookRequest $request): int
    {
        try {
            return $this->repository->update($id, $request->all());
        } catch (Throwable $exception) {
            throw $exception;
        }
    }
}
