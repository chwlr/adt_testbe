<?php

namespace App\Services\Implementation;
use App\Http\Resources\UserCollection;
use App\Repository\UserRepository;
use App\Services\UserService;

class UserServiceImpl implements UserService
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function storeUserService($attribute)
    {
        return $this->userRepository->storeUser($attribute);
    }

    public function getUsersService(): UserCollection
    {
        return $this->userRepository->getUsers();
    }

    public function findOneService($user)
    {
        return $this->userRepository->findOne($user);
    }

    public function updateUserService($attribute, $user)
    {
        return $this->userRepository->updateUser($attribute, $user);
    }

    public function deleteUserService($user)
    {
        return $this->userRepository->deleteUser($user);
    }

    public function loginUserService($attribute)
    {
        return $this->userRepository->loginUser($attribute);
    }

    public function logoutUserService()
    {
        return $this->userRepository->logoutUser();
    }
}
