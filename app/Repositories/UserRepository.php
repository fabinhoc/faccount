<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param User
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $email
     * @return User
     */
    public function findByEmail(string $email): ?User
    {
        try {
            return $this->model->where('email', $email)->first();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Find an Resource
     *
     * @param int $id
     * @return User
     */
    public function find(int $id): ?User
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
     * @return User
     */
    public function findOrFail(int $id): ?User
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
