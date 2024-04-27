<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
}

