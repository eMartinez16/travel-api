<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $req) : JsonResponse
    {
        $users = User::orderBy('id', 'desc');
        /** 
         * @TODO filters */
        return response()->json( $users->get() ,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     */
    public function store(UserRequest $request) : JsonResponse
    {
        if($request->isMethod('POST')){
            if($request->validated()){
                $newUser = $request->validated();
                $newUser['password'] =  Hash::make($request->password);

                if(!User::create($newUser)){
                    throw new \Exception("Error creating user", 500);
                }

                return response()->json('User created successfully', 200);
            }
        }
    }

    /**
     * Display the specified user.
     */
    public function show(int $userId) : JsonResponse
    {
        return response()
                ->json(
                    ['User' => User::findOrFail($userId)]
                ,200);
    }
    /**
     * Update the specific user.
     */
    public function update(UserRequest $req, int $userId) : JsonResponse
    {
        if(request()->isMethod('patch')){
            if($req->validated()){
                $user =  User::findOrFail($userId);
    
                if(!$user->update($req->validated())){
                    throw new \Exception("Error updating user", 500);
                }

                return response()->json('User updated successfully', 200);
            }
        }
    }

    /**
     * Remove the specified user.
     *
     */
    public function destroy(int $userId)
    {
        if(request()->isMethod('delete')){
            $user =  User::findOrFail($userId);

            if(!$user->delete()){
                throw new \Exception("Error deleting user", 500);
            }

            return response()->json('User deleted successfully', 200);
        }
        
    }
}
