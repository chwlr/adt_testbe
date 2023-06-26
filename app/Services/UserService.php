<?php

namespace App\Services;

interface UserService
{
    public function storeUserService($attribute);
    public function getUsersService();
    public function findOneService($user);
    public function updateUserService($attribute);
    public function deleteUserService($user);
    public function loginUserService($attribute);
    public function logoutUserService();
}
