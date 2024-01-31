<?php

namespace App\Repositories;

use App\Models\Notebook;
use Exception;
use App\Models\User;
use App\Repositories\Interfaces\NotebookRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class NotebookRepository extends AbstractRepository implements NotebookRepositoryInterface
{
    /**
     * NotebookRepository constructor.
     *
     * @param Notebook
     */
    public function __construct(Notebook $model)
    {
        parent::__construct($model);
    }

    /**
     * Find an Resource
     *
     * @param int $id
     * @return Notebook
     */
    public function find(int | array $id): ?Notebook
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
     * @return Notebook
     */
    public function findOrFail(int $id): ?Notebook
    {
        try {
            return $this->model->findOrFail($id);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function paginate(Request $request): LengthAwarePaginator
    {
        try {
            $per_page = (isset($request->per_page))
                ? $request->per_page
                : (int) getenv('ITEMS_PER_PAGE', 15);
            $column = (isset($request->sortBy) && !empty($request->sortBy))
                ? $request->sortBy
                : 'id';
            $direction = (isset($request->sortDesc) && filter_var($request->sortDesc, FILTER_VALIDATE_BOOLEAN))
                ? 'DESC'
                : 'ASC';

            return $this->model->searchable($request)->orderBy($column, $direction)->paginate($per_page);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
