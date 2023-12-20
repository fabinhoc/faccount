<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseRepositoryInterface
{
    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator
     */
    public function paginate(Request $request): LengthAwarePaginator;

    /**
     *
     * @return array
     */
    public function all(): ?Collection;

   /**
    * @param int $id
    *
    * @return Model
    */
    public function find(int $id): ?Model;

    /**
     * Find or fail model
     *
     * @param int $id
     * @return Model
     */
    public function findOrFail(int $id): ?Model;

   /**
    * @param array $attributes
    * @return Model
    */
    public function create(array $attributes): ?Model;

   /**
    * @param int $id
    * @param array $attributes
    *
    * @return Model
    */
    public function update(int $id, array $attributes): int;

    /**
     * @param int $id
     *
     * @return int
     */
    public function destroy(int $id): int;
}
