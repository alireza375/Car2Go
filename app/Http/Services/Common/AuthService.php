<?php

namespace App\Http\Services\Common;

use Exception;
use App\Models\Otp;
use App\Models\User;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function Registration($request){
        $role = USER;
        if($request->role == "user" || $request->role == "admin"){
            if($request->role == "user"){
                $role = USER;
            }else{
                $role = ADMIN;
            }
        }else{
            return errorResponse(__('Invalid role'));
        }
        $checkEmail = User::where(['email' => $request->email])->exists();
        if($checkEmail){
            return errorResponse(('Email Already exist'));
        }

        $data = [
            'uuid' => Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $role,
            'status' => ACTIVE,
            'password' => Hash::make($request->password),
            'is_mail_verified' => ENABLE
        ];

        try{
            $user = User::create($data);
            $token = $user->createToken($user->uuid . 'user')->accessToken;
            return response()->json([
                'error' => false,
                'msg' => 'User registered successfully',
                'data' => [
                    'token' => $token,
                    'role' => $request->role,
            ]
        ]);
        }catch(Exception $e){
            return errorResponse($e->getMessage());
        }

    }


    // For Login User
    public function Login($request){
        $user = User::where(['email' =>$request->email])->first();
        if(empty($user)){
            return errorResponse(('User Not Found'));
        }
        if(!Hash::check($request->password, $user->password)){
            return errorResponse(('Password Not Matched'));
        }
        // $data = User::all();
        $token = $user->createToken($user->uuid. 'user')->accessToken;
        return response()->json([
            'error' => false,
            'msg' => 'Login successfully',
            'data' => [
                'token' => $token,
                'role' => $user->role == USER ? 'user' : 'admin',
                // 'user' => $user
            ]
        ]);
    }

    // Reset passwordc
    public function ResetPassword($request)
    {
        $decoded = JWT::decode($request->token, new Key(env('JWT_SECRET'), 'HS256'));
        $decoded_array = (array) $decoded;
         $decoded_array['email'];

        $user = User::where(['email' => $decoded_array['email']])->first();
        if (empty($user)) {
            return errorResponse(__('User not found'));
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return successResponse(__('Password reset successfully'));

    }


    public function UpdatePassword($request){
        $user = Auth::guard('user')->user();
        $user = User::where(['email' => $user->email])->first();
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                    "error" => true,
                    "msg" => "Invalid old password"
            ]);

            return errorResponse(__('Old password not matched'));
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->jeson([
            'error' => false,
            'msg' => 'Successfully Updated Password '
        ]);
        // return successResponse(__('Password updated successfully'));
    }


}


