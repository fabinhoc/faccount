<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class AbstractRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Find an Resource
     *
     * @param int $id
     * @return Model
     */
    public function find(int $id): ?Model
    {
        try {
            return $this->model->find($id);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find or fail Resource
     *
     * @param int $id
     * @return Model
     */
    public function findOrFail(int $id): ?Model
    {
        try {
            return $this->model->findOrFail($id);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get all Resources
     *
     * @return LengthAwarePaginator
     */
    public function paginate(Request $request): LengthAwarePaginator
    {
        try {
            $per_page = (isset($request->per_page)) ? $request->per_page : (int) getenv('ITEMS_PER_PAGE', 15);

            $column = (isset($request->sortBy) && !empty($request->sortBy)) ? $request->sortBy : 'id';
            $direction = (isset($request->sortDesc) && filter_var($request->sortDesc, FILTER_VALIDATE_BOOLEAN)) ? 'DESC' : 'ASC';

            return $this->model::orderBy($column, $direction)->searchable($request)->paginate($per_page);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function all(): Collection
    {
        try {
            return $this->model->all();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): ?Model
    {
        try {
            return $this->model::create($attributes);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update an Resource
     *
     * @param int $id
     * @param array $attributes
     *
     * @return int
     */
    public function update(int $id, array $attributes): int
    {
        try {
            return $this->model::where('id', $id)->update($attributes);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Destroy an Resource
     *
     * @param int $id
     *
     * @return int
     */
    public function destroy(int $id): int
    {
        try {
            return $this->model::where('id', $id)->delete();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
