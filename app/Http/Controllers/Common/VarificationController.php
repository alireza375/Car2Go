<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\Common\OtpRequest;
use App\Http\Services\Common\VarificationService;
use Illuminate\Http\Request;

class VarificationController extends Controller
{
    //
    private $varificationService;

    public function __construct(VarificationService $varificationService){
        $this->varificationService = $varificationService;
    }

    public function VerifyOtp(Request $request){
        return $this->varificationService->VerifyOtp($request);
    }

    public function SendOtp(OtpRequest $request){
        return $this->varificationService->SendOtp($request);
    }
}
