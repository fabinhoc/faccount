<?php

namespace App\Services;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Throwable;
use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Services\Interfaces\TagServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TagService implements TagServiceInterface
{
    private $repository;

    public function __construct()
    {
        $this->repository = app(TagRepositoryInterface::class);
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

    public function show(int $id): ?Tag
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

    public function store(StoreTagRequest $request): ?Tag
    {
        try {
            $attributes = $request->all();
            $attributes = array_merge($attributes, ['user_id' => auth()->user()->id]);
            return $this->repository->create($attributes);
        } catch (Throwable $exception) {
            throw $exception;
        }
    }

    public function update(int $id, UpdateTagRequest $request): int
    {
        try {
            return $this->repository->update($id, $request->all());
        } catch (Throwable $exception) {
            throw $exception;
        }
    }
}
