<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function register(RegisterRequest $req) : JsonResponse
    {
        if($req->isMethod('POST')){
            if($req->validated()){
                $newUser = $req->all();
                $newUser['password'] =  Hash::make($req->password);
                if(!User::create($newUser)){

                    throw new \Exception("Error creating user", 500);
                }

                return response()->json('User registered successfully', 200);
            }
        }else{
            throw new \Exception("INVALID METHOD", 500);
        }
    }

    /**
     * @param Request $req
     */
    public function login(Request $req) : JsonResponse
    {
        /**FIXME: Make an custom request */
        if(!Auth::attempt(['email' => $req->email, 'password' => $req->password])){
            throw new \Exception("Unauthorized", 500);
                 
        }

        $user = User::findByEmail($req->email)->first();
        
        $token = $user->createToken('authToken')->plainTextToken;

        return response()
                ->json([
                    'token' => $token,
                    'user'=> $user
                ],
                200);
    }


    public function logout(): JsonResponse
    {
        Session::flush();
        
        Auth::logout();

        return response()->json('Logged out successfully', 200);
    }

    // public function resetPassword() : JsonResponse
    // {

    // }
}
