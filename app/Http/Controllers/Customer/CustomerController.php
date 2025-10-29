<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ICustomerService;

class CustomerController extends Controller
{
    protected ICustomerService $customerService;

    public function __construct(ICustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:8',
        ]);

        $customer = $this->customerService->register($validated);

        return response()->json([
            'message' => 'Customer created successfully!',
            'customer_data' => $customer,
        ], 201);
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $result = $this->customerService->login($credentials['email'], $credentials['password']);

        if (!$result) {
            return response()->json(['message' => 'Invalid email or password.'], 401);
        }

        return response()->json([
            'message' => 'Login successful!',
            'customer_data'    => $result['customer_data'],
            'token'   => $result['token'],
        ]);
    }

    public function profile(Request $request) {
        return response()->json($request->user());
    }

    public function updateProfile(Request $request) {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'sometimes|string|max:20|nullable',
            'address' => 'sometimes|string|max:255|nullable',
        ]);

        $data = $request->only(['name','phone_number','address']);

        $updatedCustomer = $this->customerService->updateProfile($request->user()->id, $data);
        
        return response()->json([
            'message' => 'Profile updated successfully',
            'customer' => $updatedCustomer
        ]);

    }

    public function logout(Request $request) {
        $request->user()?->currentAccessToken()?->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
