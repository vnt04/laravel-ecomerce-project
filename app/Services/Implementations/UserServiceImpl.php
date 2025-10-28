<?php

namespace App\Services\Implementations;

use App\Models\User;
use App\Services\UserService;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;


class UserServiceImpl implements UserService{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $newUserData) {
        return $this->userRepository->create($newUserData);
    }

    public function login(string $email, string $password)
    {
        $user = $this->userRepository->findByEmail($email);

        if (!$user || !Hash::check($password, $user->password)) {
            return null;
        }
        $token = $this->userRepository->createToken($user,'api_token');

        return [
            'user'  => $user,
            'token' => $token
        ];
    }


    public function getUserByEmail(string $email)
    {
        return $this->userRepository->findByEmail($email);
    }
}