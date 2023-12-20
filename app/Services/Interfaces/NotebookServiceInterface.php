<?php

namespace App\Services\Interfaces;

use App\Http\Requests\StoreNotebookRequest;
use App\Http\Requests\UpdateNotebookRequest;
use App\Models\Notebook;

interface NotebookServiceInterface extends BaseServiceInterface
{
    public function store(StoreNotebookRequest $request): ?Notebook;

    public function update(int $id, UpdateNotebookRequest $request): int;
}
