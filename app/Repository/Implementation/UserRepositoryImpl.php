<?php

namespace App\Repository\Implementation;
use App\Models\User;
use App\Repository\UserRepository;

class UserRepositoryImpl implements UserRepository
{
    protected $user;
    public function __construct(User $user)
    {
        $this->$user = $user;
    }

    public function storeUser($data)
    {
        return "user data";
    }

    public function getUsers()
    {
        return "users data";
    }

    public function findOne($user, $data)
    {
        return "user data";
    }

    public function updateUser($user, $data)
    {
        return "user data";
    }

    public function deleteUser($user)
    {
        return "success";
    }
}
