<?php

namespace App\Repository\Implementation;
use App\Exceptions\GeneralJsonException;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repository\UserRepository;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepositoryImpl implements UserRepository
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @throws GeneralJsonException
     */
    public function storeUser(array $data): UserResource
    {
        try {
            DB::beginTransaction();
            $stored = $this->user->query()->create([
                'name' => data_get($data, 'name'),
                'email' => data_get($data, 'email'),
                'password' => Hash::make(data_get($data, 'password'))
            ]);
            DB::commit();
            $token = $stored->createToken('authToken')->plainTextToken;
            return (new UserResource($stored->fresh()))->additional(['token' => $token]);
        } catch (Exception $e){
            DB::rollBack();
            throw new GeneralJsonException('Failed to store data', 400);
        }
    }

    public function getUsers(): UserCollection
    {
        try {
            return new UserCollection($this->user->get());
        } catch (Exception $e) {
            throw new GeneralJsonException('Failed to retrieve data', 400);
        }
    }

    public function findOne($user): UserResource
    {
        try {
            return new UserResource($this->user->find($user));
        } catch (Exception $e) {
            throw new GeneralJsonException('Failed to retrieve data', 400);
        }
    }

    public function updateUser($user, $data): UserResource
    {
        try {
            DB::beginTransaction();
            $user = $this->user->query()->update([
                'name' => data_get($data, 'name'),
                'email' => data_get($data, 'email'),
                'password' => Hash::make(data_get($data, 'password'))
            ]);
            DB::commit();
            return new UserResource($user);
        } catch (Exception $e){
            DB::rollBack();
            throw new GeneralJsonException('Failed to update data', 400);
        }
    }

    public function deleteUser($user)
    {
        try {
            DB::beginTransaction();
            $user = $this->user->findOrFail($user);
            $user->delete();
            DB::commit();
            return response()->json("Data deleted");
        } catch (Exception $e){
            DB::rollBack();
            throw new GeneralJsonException('Failed to delete data', 400);
        }
    }

    public function loginUser($user): UserResource
    {
        if (Auth::attempt(['email' => data_get($user, 'email'), 'password' => data_get($user, 'password')]))
        {
            $authUser = Auth::user();
            $token = $authUser->createToken('authToken')->plainTextToken;
            return (new UserResource($authUser))->additional(['token' => $token]);
        } else {
            throw new GeneralJsonException('Invalid email or password', 400);
        }

    }

    public function logoutUser(): JsonResponse
    {
        try {
            $authUser = Auth::user();
            $authUser->currentAccessToken()->delete();
            return response()->json("goodbye");
        }catch (Exception $e)
        {
            throw new GeneralJsonException('Failed to logout user', 400);
        }
    }
}
