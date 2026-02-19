<?php

namespace App\Repositories;

use App\Models\Announcement;
use App\Repositories\Contracts\AnnouncementRepositoryInterface;

class AnnouncementRepository implements AnnouncementRepositoryInterface 
{
    protected $model;

    public function __construct(Announcement $model) 
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