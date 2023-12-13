<?php

namespace App\Services\Interfaces;

use App\Http\Requests\StoreBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Models\Bill;

interface BillServiceInterface extends BaseServiceInterface
{
    public function store(StoreBillRequest $request): ?Bill;

    public function update(int $id, UpdateBillRequest $request): int;
}
