<?php

namespace App\Http\WebControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\IUserService;


class AuthController extends Controller
{
    
    protected IUserService $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * show login view
     */
    public function showLogin() {
        return view('auth.login');
    }

    /**
     * Handle user login via API.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $result = $this->userService->login($credentials['email'], $credentials['password']);

        if (!$result) {
            return response()->json(['message' => 'Invalid email or password.'], 401);
        }

        return response()->json([
            'message' => 'Login successful!',
            'user'    => $result['user'],
            'token'   => $result['token'],
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()?->currentAccessToken()?->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
