<?php

namespace App\Http\Services\Common;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class ProfileService
{
    public function makeData($request){
        $data = [
            'name' => $request->Name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $request->hasFile('image') ? fileUpload($request->file('image'), PATH_GALLERIES) :  null,

        ];
        return $data;
    }

    public function GetProfile(){
        return successResponse(__('Profile fetched successfully.'),
            UserResource::make(Auth::guard('checkUser')
            ->user())
        );
    }


    public function DetailsProfile($request){
        $profile = User::find($request->uuid);

        if (empty($profile)) {
            return errorResponse(__('User not found'));
        } else {
            return successResponse(__('Profile Details Found.'), $profile);
        }
    }



    public function FindProfile($request)
    {
        $user = User::where(['email' => $request->email])->first();
        if (empty($user)) {

            return errorResponse(__('User not found'));
        } else {
            return successResponse(__('Account Found.'), ['account' => true, 'role' => $user->role == 1 ? 'user' :  'admin']);
        }
    }


    public function UserUpdate($request){
        $user = Auth::guard('checkUser')->user();
        $user = User::where(['email' => $user->email])->first();

        $data = $request->all();

        try {
            $user->update($data);
            return successResponse(__('Profile updated successfully.'), UserResource::make($user));
        } catch (\Exception $e) {
            return errorResponse($e->getMessage());
        }
    }

}
