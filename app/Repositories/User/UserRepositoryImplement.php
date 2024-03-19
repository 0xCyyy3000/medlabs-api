<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class UserRepositoryImplement extends Eloquent implements UserRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function findBy($column, $value)
    {
        return $this->model->where($column, $value)->firstOrFail();
    }

    public function update($id, array $data)
    {
        if ($user = $this->find($id)) {
            $user->update($data);
            return $user;
        }

        throw new NotFoundResourceException();
    }

    public function create($payload)
    {
        return $this->find(
            $this->model->create($payload)->id
        );
    }

    public function delete($id)
    {
        $user = $this->find($id);
        $user->delete();
        return $user;
    }
}
