<?php

namespace App\Services;

use App\Repositories\Contracts\SocialMediaRepositoryInterface;
use App\Services\Contracts\SocialMediaServiceInterface;

class SocialMediaService implements SocialMediaServiceInterface 
{
    protected $repo;

    public function __construct(SocialMediaRepositoryInterface $repo) 
    { 
        $this->repo = $repo; 
    }

    public function listTable() { return $this->repo->getQuery(); }
    public function find(string $id) { return $this->repo->find($id); }
    public function store(array $data) { return $this->repo->store($data); }
    public function update(string $id, array $data) { return $this->repo->update($id, $data); }
    public function delete(string $id) { return $this->repo->delete($id); }
}