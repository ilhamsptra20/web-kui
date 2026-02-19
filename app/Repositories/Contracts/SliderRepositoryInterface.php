<?php

namespace App\Repositories\Contracts;

interface SliderRepositoryInterface
{
    public function getQuery();
    public function find(string $id);
    public function store(array $data);
    public function update(string $id, array $data);
    public function delete(string $id);
}