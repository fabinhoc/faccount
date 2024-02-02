<?php

namespace App\Services\Interfaces;

use App\Http\Requests\DuplicateBilRequest;
use App\Http\Requests\StoreBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Models\Bill;
use Illuminate\Database\Eloquent\Collection;

interface BillServiceInterface extends BaseServiceInterface
{
    public function store(StoreBillRequest $request): ?Bill;

    public function update(int $id, UpdateBillRequest $request): int;

    public function findByNotebookIdAndYearAndMonth(int $notebookId, string $year, string $month): Collection;

    public function duplicateBills(DuplicateBilRequest $request): bool;

    public function destroyMany(int $notebookId, string $year, string $month): bool;
}
