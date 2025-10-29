<?php
namespace App\Services;

interface ICustomerService {
    function register($newCustomerData);
    function login(string $email, string $password);
    function updateProfile(int $customerId, array $data);
}