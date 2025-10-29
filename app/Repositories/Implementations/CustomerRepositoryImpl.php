<?php
namespace App\Repositories\Implementations;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use App\Repositories\ICustomerRepository;

class CustomerRepositoryImpl implements ICustomerRepository {
    public function create($newCustomerData){
        return Customer::create([
            'name' => $newCustomerData['name'],
            'email' => $newCustomerData['email'],
            'password' => Hash::make($newCustomerData['password']),
        ]);
    }

    public function findByEmail(string $email) {
        return Customer::where('email', $email)->first();
    }

    public function createToken(Customer $customer, string $tokenName): string {
        return $customer->createToken($tokenName)->plainTextToken;
    }

    public function findById(int $customerId): ?Customer {
        return Customer::find($customerId);
    }

    public function updateProfile(int $customerId, array $data) {
        $customer = Customer::find($customerId);
        if(isset($data['name'])) {
            $customer->name = $data['name'];
        }

        if(isset($data['phone_number'])) {
            $customer->phone_number = $data['phone_number'];
        }

        if(isset($data['address'])) {
            $customer->address = $data['address'];
        }
        $customer->save();
        return $customer;
    }
}