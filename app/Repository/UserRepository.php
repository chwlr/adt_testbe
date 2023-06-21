<?php

namespace App\Repository;

interface UserRepository
{
    public function storeUser($data);
    public function getUsers();
    public function findOne($user);
    public function updateUser($user, $data);
    public function deleteUser($user);
}
