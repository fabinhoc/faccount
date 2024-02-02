<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface BillRepositoryInterface extends BaseRepositoryInterface
{
    public function findByNotebookIdAndYearAndMonth(int $notebookId, string $month, string $year): ?Collection;

    public function createMany(array $data): bool;

    public function destroyMany(array $ids): bool;
}
