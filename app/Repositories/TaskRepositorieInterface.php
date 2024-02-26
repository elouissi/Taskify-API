<?php

namespace App\Repositories;


interface TaskRepositorieInterface
{
    public function getById($id);

    public function getAll();
    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);
}