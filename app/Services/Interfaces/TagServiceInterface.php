<?php

namespace App\Services\Interfaces;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;

interface TagServiceInterface extends BaseServiceInterface
{
    public function store(StoreTagRequest $request): ?Tag;

    public function update(int $id, UpdateTagRequest $request): int;
}
