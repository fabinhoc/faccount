<?php

namespace App\Services;

use App\Http\Requests\DuplicateBilRequest;
use App\Http\Requests\StoreBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Models\Bill;
use App\Repositories\Interfaces\BillRepositoryInterface;
use Throwable;
use App\Services\Interfaces\BillServiceInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class BillService implements BillServiceInterface
{
    private $repository;

    public function __construct()
    {
        $this->repository = app(BillRepositoryInterface::class);
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

    public function show(int $id): ?Bill
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

    public function store(StoreBillRequest $request): ?Bill
    {
        try {
            $attributes = $request->all();
            $attributes = array_merge($attributes, ['user_id' => auth()->user()->id]);
            return $this->repository->create($attributes);
        } catch (Throwable $exception) {
            throw $exception;
        }
    }

    public function update(int $id, UpdateBillRequest $request): int
    {
        try {
            return $this->repository->update($id, $request->all());
        } catch (Throwable $exception) {
            throw $exception;
        }
    }

    public function findByNotebookIdAndYearAndMonth(int $notebookId, string $year, string $month): Collection
    {
        try {
            return $this->repository->findByNotebookIdAndYearAndMonth($notebookId, $year, $month);
        } catch (Throwable $exception) {
            throw $exception;
        }
    }

    public function duplicateBills(DuplicateBilRequest $request): bool
    {
        try {
            DB::transaction(function() use ($request) {
                $bills = $this->repository->findByNotebookIdAndYearAndMonth(
                    $request->notebook_id,
                    $request->year,
                    $request->month
                );
                $duplicateBills = [];
                foreach($bills as $bill) {
                    $dueDate = Carbon::createFromFormat('Y-m-d', $bill->due_date);
                    $newDueDate = Carbon::createFromFormat(
                        'Y-m-d',
                        "$request->duplicateYear-$request->duplicateMonth-$dueDate->day"
                    );
                    $bill->due_date = $newDueDate;

                    $splitBills = [
                        'name' => $bill->name,
                        'description' => $bill->description,
                        'price' => $bill->price,
                        'is_paid' => false,
                        'total_paid' => null,
                        'due_date' => $newDueDate,
                        'tag_id' => $bill->tag_id,
                        'notebook_id' => $bill->notebook_id,
                        'user_id' => $bill->user_id
                    ];
                    array_push($duplicateBills, $splitBills);
                }
                $this->repository->createMany($duplicateBills);
                return true;
            });
            return false;
        } catch (Throwable $exception) {
            throw $exception;
        }
    }

    public function destroyMany(int $notebookId, string $year, string $month): bool
    {
        try {
            $bills = $this->repository->findByNotebookIdAndYearAndMonth($notebookId, $year, $month);
            $pluckedIds = collect($bills)->pluck('id');

            return $this->repository->destroyMany($pluckedIds->all());
        } catch (Throwable $exception) {
            throw $exception;
        }
    }
}
