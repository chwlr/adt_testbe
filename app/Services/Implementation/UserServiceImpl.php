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

    public function storeUserService($data)
    {
        return $this->userRepository->storeUser($data);
    }

    public function getUsersService(): UserCollection
    {
        return $this->userRepository->getUsers();
    }

    public function findOneService($user)
    {
        return $this->userRepository->findOne($user);
    }

    public function updateUserService($user, $data)
    {
        return $this->userRepository->updateUser($user, $data);
    }

    public function deleteUserService($user)
    {
        return $this->userRepository->deleteUser($user);
    }

    public function loginUserService($data)
    {
        return $this->userRepository->loginUser($data);
    }

    public function logoutUserService()
    {
        return $this->userRepository->logoutUser();
    }
}
