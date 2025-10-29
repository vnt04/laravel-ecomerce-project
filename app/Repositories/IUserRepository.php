<?php
namespace App\Repositories;
use App\Models\User;

interface IUserRepository {
    function create(array $data): User;
    function findByEmail(string $email): ?User;
    function findById(int $userId): ?User;
    function createToken(User $user, string $tokenName): string;
    function updateStatus(int $userId, string $status): User;
}