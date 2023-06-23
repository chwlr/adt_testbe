<?php

namespace App\Repository\Implementation;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repository\UserRepository;

use Illuminate\Support\Facades\Hash;

class UserRepositoryImpl implements UserRepository
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function storeUser(array $data)
    {
        $this->user->name = $data['name'];
        $this->user->email = $data['email'];
        $this->user->password = Hash::make($data['password']);
        $this->user->save();

        $token = $this->user->createToken('authToken')->plainTextToken;

        return (new UserResource($this->user->fresh()))->additional(['token' => $token]);
    }

    public function getUsers()
    {
        return new UserCollection($this->user->get());
    }

    public function findOne($user)
    {
        return new UserResource($this->user->find($user));
    }

    public function updateUser($user, $data)
    {
        $user = $this->user->findOrFail($user);
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);

        return new UserResource($user);
    }

    public function deleteUser($user)
    {
        return "success";
    }
}
