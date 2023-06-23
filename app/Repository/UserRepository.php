<?php

namespace App\Repository;

use App\Http\Resources\UserResource;

interface UserRepository
{
    public function storeUser(array $data);
    public function getUsers();
    public function findOne($user);
    public function updateUser($user, $data);
    public function deleteUser($user);
}
