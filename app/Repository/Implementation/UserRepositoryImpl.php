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
    public function storeUser(array $attribute): UserResource
    {
        try {
            DB::beginTransaction();
            $stored = $this->user->query()->create([
                'name' => data_get($attribute, 'name'),
                'email' => data_get($attribute, 'email'),
                'password' => Hash::make(data_get($attribute, 'password'))
            ]);
            $token = $stored->createToken('authToken')->plainTextToken;
            DB::commit();
            return (new UserResource($stored->fresh()))->additional(['token' => $token]);
        } catch (Exception $e){
            DB::rollBack();
            throw new GeneralJsonException($e->getMessage(), 400);
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
            return new UserResource($this->user->findOrFail($user));
        } catch (Exception $e) {
            throw new GeneralJsonException('Failed to retrieve data', 400);
        }
    }

    public function updateUser($attribute, $user): UserResource
    {
        $user = $this->user->find($user);
        if (empty($user)) {
            throw new GeneralJsonException('Failed to update, data not found', 404);
        }

        try {
            DB::beginTransaction();
            $user->update([
                'name' => data_get($attribute, 'name') == null ? $user->getOriginal('name') : data_get($attribute, 'name'),
                'email' => data_get($attribute, 'email') == null ? $user->getOriginal('email') : data_get($attribute, 'email'),
                'password' => $user->getOriginal('password')
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
        $user = $this->user->find($user);
        if (empty($user)) {
            throw new GeneralJsonException('Failed to delete, data not found', 404);
        }

        try {
            DB::beginTransaction();
            $user->delete();
            DB::commit();
            return response()->json("Data deleted");
        } catch (Exception $e){
            DB::rollBack();
            throw new GeneralJsonException('Failed to delete data', 400);
        }
    }

    public function loginUser($attribute): UserResource
    {
        if (Auth::attempt(['email' => data_get($attribute, 'email'), 'password' => data_get($attribute, 'password')]))
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
