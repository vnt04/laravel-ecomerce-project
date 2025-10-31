<?php

namespace App\Http\WebControllers;


use Illuminate\Http\Request;
use App\Services\IUserService;
use App\Http\Controllers\Controller;



class RegisterController extends Controller
{
    protected $redirectTo = "/home";
    protected IUserService $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * show register view
     */
    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = $this->userService->register($validated);

        return response()->json([
            'message' => 'User created successfully!',
            'user' => $user,
        ], 201);
    }


    public function test()
    {
        return response()->json([
            'message' => 'test'
        ]);
    }

}
