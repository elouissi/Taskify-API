<?php

namespace App\Repositories;

use App\Models\User;

class UserRepositorie implements UserRepositorieInterface
{
    public function getById($id)
    {
        return User::findOrFail($id);
    }
    public function getByEmail($email)
{
    return User::where('email', $email)->first();
}

    public function create(array $data)
    {
        return User::create($data);
    }
    public function getAll()
    {
        return User::all();
    }

    public function update($id, array $data)
    {
        $User = $this->getById($id);
        $User->update($data);
        return $User;
    }

    public function delete($id)
    {
        $User = $this->getById($id);
        $User->delete();
    }
}