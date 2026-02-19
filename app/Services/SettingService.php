<?php

namespace App\Services;

use App\Repositories\Contracts\SettingRepositoryInterface;
use App\Services\Contracts\SettingServiceInterface;

class SettingService implements SettingServiceInterface 
{
    protected $repo;

    public function __construct(SettingRepositoryInterface $repo) 
    { 
        $this->repo = $repo; 
    }

    public function listTable() { return $this->repo->getQuery(); }
    public function find(string $id) { return $this->repo->find($id); }
    public function store(array $data) { return $this->repo->store($data); }
    public function update(string $id, array $data) { return $this->repo->update($id, $data); }
    public function delete(string $id) { return $this->repo->delete($id); }
}