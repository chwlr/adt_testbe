<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

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
     * Authenticate User login.
     */
    public function login(LoginUserRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $authUser = Auth::user();
            $token = $authUser->createToken('authToken')->plainTextToken;
            return (new UserResource($authUser))->additional(['token' => $token]);
        } else {
            $error = [
                'status' => 400,
                'error' => 'Invalid email and password'
            ];
            return response()->json($error, $error['status']);
        }
    }

    /**
     * Authenticate User logout.
     */
    public function signup(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json("goodbye");
        }catch (\Exception $e)
        {
            return response()->json($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->safe()->only(['name', 'email', 'password']);
        $result = $this->userService->storeUserService($data);
        return $result->response()->setStatusCode(201);
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
    public function update(Request $request, $user)
    {
        return $this->userService->updateUserService($user, $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
