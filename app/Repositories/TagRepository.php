<?php

namespace App\Repositories;

use App\Models\Tag;
use Exception;
use App\Repositories\Interfaces\TagRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TagRepository extends AbstractRepository implements TagRepositoryInterface
{
    /**
     * TagRepository constructor.
     *
     * @param Tag
     */
    public function __construct(Tag $model)
    {
        parent::__construct($model);
    }

    /**
     * Find an Resource
     *
     * @param int $id
     * @return Tag
     */
    public function find(int | array $id): ?Tag
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
     * @return Tag
     */
    public function findOrFail(int $id): ?Tag
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
