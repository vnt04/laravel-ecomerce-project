<?php
namespace App\Services;

use App\Models\User;

interface IUserService {
    function register(array $newUserData);
    function login(string $email, string $password);
    function getUserByEmail(string $email);
    function updateStatus(int $userId, string $status): User;
}