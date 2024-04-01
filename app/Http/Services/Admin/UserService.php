<?php

namespace App\Http\Services\Admin;

use App\Http\Resources\UserResource;
use App\Models\User;

class UserService
{

    public function makeData($request)
    {
        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'image' => $request->get('image'),
            'role' => $request->get('role')
        ];
        return $data;
    }

    public function index(){
        $user = User::where(['role' => USER])->get();
        $data = UserResource::collection($user);
        return successResponse(__('Users fetched successfully.'), $data);

    }

}
