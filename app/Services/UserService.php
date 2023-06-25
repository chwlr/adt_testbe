<?php

namespace App\Services;

interface UserService
{
    public function storeUserService($data);
    public function getUsersService();
    public function findOneService($user);
    public function updateUserService($user, $data);
    public function deleteUserService($user);
    public function loginUserService($data);
    public function logoutUserService();
}
