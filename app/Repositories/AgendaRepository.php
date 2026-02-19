<?php

namespace App\Repositories;

use App\Models\Agenda;
use App\Repositories\Contracts\AgendaRepositoryInterface;

class AgendaRepository implements AgendaRepositoryInterface 
{
    protected $model;

    public function __construct(Agenda $model) 
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