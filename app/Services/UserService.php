<?php
namespace App\Services;

use App\Models\User;

interface UserService {
    public function register(array $newUserData);
    public function login(string $email, string $password);
    public function getUserByEmail(string $email);
}