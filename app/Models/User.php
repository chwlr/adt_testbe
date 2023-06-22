<?php

namespace App\Models;



use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasFactory, HasUuids, HasApiTokens;
    protected $fillable = ['name', 'email', 'password', 'created_at', 'updated_at'];
    protected $table = 'user';
}
