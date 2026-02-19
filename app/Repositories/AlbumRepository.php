<?php

namespace App\Repositories;

use App\Models\Album;
use App\Repositories\Contracts\AlbumRepositoryInterface;

class AlbumRepository implements AlbumRepositoryInterface 
{
    protected $model;

    public function __construct(Album $model) 
    { 
        $this->model = $model; 
    }

    public function getQuery() { return $this->model->query(); }
    public function find(string $id) { return $this->model->findOrFail($id); }
    public function store(array $data) { return $this->model->create($data); }
    public function update(string $id, array $data) 
    { 
        $row = $this->find($id); 
        $row->update($data); 
        return $row; 
    }
    public function delete(string $id) { return $this->find($id)->delete(); }
}