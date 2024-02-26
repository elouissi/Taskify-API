<?php

namespace App\Repositories;


interface UserRepositorieInterface
{
    public function getById($id);
    
    public function getByEmail($email);
 

    public function getAll();
    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);
}