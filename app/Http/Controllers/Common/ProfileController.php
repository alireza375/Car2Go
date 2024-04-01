<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Services\Common\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    private $profileService;

    public function __construct(ProfileService $profileService){
        $this->profileService = $profileService;
    }

    public function GetProfile(){
        return $this->profileService->GetProfile();
    }

    public function DetailsProfile(Request $request){
        return $this->profileService->DetailsProfile($request);
    }


    public function FindProfile(Request $request){
        return $this->profileService->FindProfile($request);
    }

    public function UserUpdate(Request $request){
        return $this->profileService->UserUpdate($request);
    }


}
