<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\LoginRequest;
use App\Repositories\UserRepositorieInterface;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    
    protected $UserRepositorieInterface;


    public function __construct(UserRepositorieInterface $UserRepositorieInterface){
        $this->UserRepositorieInterface = $UserRepositorieInterface;
    }
   
    public function register(RegisterRequest $request){
        $registerUserData = $request->validated();
        $registerUserData['password'] = Hash::make($registerUserData['password']);
        $this->UserRepositorieInterface->create($registerUserData);
        return response()->json([
            'message' => 'User Created ',
        ]);
    }

    public function login(LoginRequest $request){
        $loginUserData = $request->validated();

         $user = $this->UserRepositorieInterface->getByEmail($loginUserData['email']);

        if(!$user || !Hash::check($loginUserData['password'],$user->password)){
            return response()->json([
                'message' => 'Invalid Credentials'
            ],401);
        }
        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
        return response()->json([
            'access_token' => $token,
        ]);
    }
    public function logout(){
        auth()->user()->tokens()->delete();
    
        return response()->json([
          "message"=>"logged out"
        ]);
    }
}
