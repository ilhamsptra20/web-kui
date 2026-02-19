<?php

namespace App\Services\Contracts;

interface PostServiceInterface
{
    public function listTable();
    public function find(string $id);
    public function store(array $data);
    public function update(string $id, array $data);
    public function delete(string $id);
}