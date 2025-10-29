<?php

namespace App\Services\Implementations;

use App\Models\User;
use App\Services\IUserService;
use App\Repositories\IUserRepository;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserServiceImpl implements IUserService{
    protected IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
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
        $token = $this->userRepository->createToken($user,'user_token');

        return [
            'user'  => $user,
            'token' => $token
        ];
    }


    public function getUserByEmail(string $email)
    {
        return $this->userRepository->findByEmail($email);
    }

    function updateStatus(int $userId, string $status) : User{
        $user = $this->userRepository->findById($userId);
        if(!$user) {
            throw new NotFoundHttpException("User with ID {$userId} not found.");
        }
        return $this->userRepository->updateStatus($userId, $status);
    }

}