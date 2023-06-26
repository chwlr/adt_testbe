<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->userService->getUsersService();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $attribute = $request->safe()->only(['name', 'email', 'password']);
        return $this->userService->storeUserService($attribute);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $user)
    {
        $result = $this->userService->findOneService($user);
        return $result->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $user)
    {
        return $this->userService->updateUserService($user, $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user)
    {
        return $this->userService->deleteUserService($user);
    }

    /**
     * Authenticate User login.
     */
    public function login(LoginUserRequest $request)
    {
        $data = $request->safe()->only(['email', 'password']);
        return $this->userService->loginUserService($data);
    }

    /**
     * Authenticate User logout.
     */
    public function logout()
    {
        return $this->userService->logoutUserService();
    }
}
