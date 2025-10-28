<?php
namespace App\Repositories\Implementations;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserRepositoryImpl implements UserRepository {
    public function findByEmail(string $email) : ?User {
        return User::where('email', $email)->first();
    }

    public function create(array $data): User {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function createToken(User $user, string $tokenName): string {
        return $user->createToken($tokenName)->plainTextToken;
    }

}