<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\IUserService;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected IUserService $userService;

    public function __construct(IUserService $userService) {
        $this->userService = $userService;
    }

    public function profile(Request $request)
    {
        return response()->json($request->user());
    }

    public function updateStatus(Request $request, $id) {
        // assume that only admin (user id 1) can update user status
        if($request->user()->id !== 1) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $status = $request->input('status');

        // update in database
        $user = $this->userService->updateStatus($id, $status); 
        
        return response()->json(['message' => "User status for user ID {$id} has been updated to status {$status}.",'user'=> $user]);
    }

    // Other methods like: CRUD operations for users....
}
