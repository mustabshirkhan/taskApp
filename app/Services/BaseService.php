<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;

abstract class BaseService
{
    protected $repository;

    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function findById($id)
    {
        return $this->repository->findById($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($this->findById($id), $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($this->findById($id));
    }
}
