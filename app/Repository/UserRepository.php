<?php

namespace App\Repository;

interface UserRepository
{
    public function storeUser(array $attribute);
    public function getUsers();
    public function findOne($user);
    public function updateUser($attribute);
    public function deleteUser($user);
    public function loginUser($attribute);
    public function logoutUser();
}
