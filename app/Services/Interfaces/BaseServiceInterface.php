<?php

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseServiceInterface
{

   /**
    * @return LengthAwarePaginator
    */
    public function paginate(Request $request): LengthAwarePaginator;

    /**
    * @return Collection
    */
    public function all(): Collection;

   /**
    * @param int $id
    * @return int
    */
    public function show(int $id): ?Model;

   /**
    * @param int $id
    * @return int
    */
    public function destroy(int $id): int;
}
