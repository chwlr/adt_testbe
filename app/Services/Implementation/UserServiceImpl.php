<?php

namespace App\Services\Implementation;
use App\Repository\UserRepository;
use App\Services\UserService;

class UserServiceImpl implements UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function storeUserService($data)
    {
        return "something";
    }

    public function getUsersService()
    {
        return "something";
    }

    public function findOneService($user)
    {
        return "something";
    }

    public function updateUserService($user, $data)
    {
        return "something";
    }

    public function deleteUserService($user)
    {
        return "something";
    }
}
