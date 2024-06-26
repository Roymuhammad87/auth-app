<?php

namespace App\Http\Controllers\Api;

use ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class RegisterContoller extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request) {
   
        $userData = $request->validated();
        $user = User::create([
            'name'=>$userData['name'],
            'email'=>$userData['email'],
            'password'=>bcrypt($userData['password']),
        ]);
        // $token = $user->createToken('auth_token')->plainTextToken;
        $data = [
            'id'=>$user->id,
            'name'=>$user->name,
            'email'=>$user->email,
        ];
        if($user) {
            return ApiResponse::apiResponse(201, 'user created successfully', $data);
        } else {
            return response()->json( 'Invalid credentials', 422);
        }
    }
}
