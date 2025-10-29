<?php
namespace App\Repositories;

use App\Models\Customer;

interface ICustomerRepository {
    function create($newCustomerData);
    function findByEmail(string $email);
    function findById(int $customerId): ?Customer;
    function createToken(Customer $customer, string $tokenName): string;
    function updateProfile(int $customerId, array $data);
}