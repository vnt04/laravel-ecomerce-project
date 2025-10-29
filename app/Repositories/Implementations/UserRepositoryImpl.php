<?php
namespace App\Repositories\Implementations;

use App\Models\User;
use App\Repositories\IUserRepository;
use Illuminate\Support\Facades\Hash;

class UserRepositoryImpl implements IUserRepository {
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

    public function findById(int $userId): ?User {
        return User::find($userId);
    }

    public function createToken(User $user, string $tokenName): string {
        return $user->createToken($tokenName)->plainTextToken;
    }

    function updateStatus(int $userId, string $status): User {
        $user = User::find($userId);
        $user->status = $status;
        $user->save();
        return $user;
    }

}