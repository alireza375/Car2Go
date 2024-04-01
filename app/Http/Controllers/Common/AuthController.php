<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\Common\AuthRequest;
use App\Http\Services\Common\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    private $AuthService;

    public function __construct(AuthService $AuthService){
        $this->AuthService = $AuthService;
    }

    public function Registration(AuthRequest $request){
        return $this->AuthService->Registration($request);

    }

    public function Login(Request $request){
        return $this->AuthService->Login($request);
    }

    public function ResetPassword(Request $request){
        return $this->AuthService->ResetPassword($request);
    }

    public function UpdatePassword(Request $request){
        return $this->AuthService->UpdatePassword($request);
    }


}
