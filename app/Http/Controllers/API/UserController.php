<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\loginRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;


class UserController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors());
        }
    //     try {
    //         DB::beginTransaction();

            $user = User::create([
               'name' => $request->name,
               'email' => $request->email,
               'password' => Hash::make($request->password),
            //    'confirm_password' => $request->confirm_password,

            ]);

    //         DB::commit();

            return response()->json([
               'status' =>'success',
                'user' => $user
            ]);
    //     } catch (\Throwable $th) {
    //         DB::rollBack();

    //         Log::error($th);
    //         return response()->json([
    //             'status' =>'error',
    //          ],500);
    //     }
    // }
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(),[

            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors());
        }
        if (!$token = auth('api')->attempt($validator->validated())){
            return response()->json(['success'=> false , 'msg'=>'UserName or Password is incorrect']);
        }
        return $this->respondWithToken($token);


    //     if(!$token = auth('api')->attempt( $request->validate()))
    //     {
    //         return response()->json(['success'=> false , 'msg'=>'UserName or Password is incorrect']);
    // }
    // return $this->respondWithToken($token);
}
    protected function RespondWithToken($token){
        return response()->json([
            'success'=> true,
            'access_token'=> $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
    }
}


