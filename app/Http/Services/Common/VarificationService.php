<?php

namespace App\Http\Services\Common;

use Carbon\Carbon;
use App\Models\Otp;
use Illuminate\Support\Facades\Hash;

class VarificationService
{
    public function SendOtp($request){
        $otp = randomNumber(4);
        do {
            $otp = randomNumber(4);
            $exists_otp = Otp::where(['otp' => $otp])->exists();
        } while ($exists_otp);

        $token_data = [
            'otp' => $otp,
            'type' => $request->action,
            'expired_at' => Carbon::now()->addMinutes(3),
            'email' =>  $request->email
        ];
        

        try {
            Otp::updateOrCreate(['email' => $request->email], $token_data);
            // $data = [
            //     'email' => $request->email,
            //     'expired_at' => $token_data['expired_at'],
            //     'otp'    => $otp,
            // ];
            return response()->json([
                'error' => false,
                'msg' => "OTP send Successfully",
                'Data' => $otp,
            ]);
            // return successResponse(__("OTP send Successfully"), ['data' => $otp]);
        } catch (\Exception $e) {
            return errorResponse($e->getMessage());
        }
    }

    public function VerifyOtp($request){
        $otp = Otp::where(['otp' => $request->otp, 'email' =>$request->email])->first();
        if(empty($otp)){
            return errorResponse(('not_matched'), ['key' => __('OTP')]);
        }
        if(Carbon::now() > Carbon::parse($otp ->expired_at)){
            return errorResponse(__('OTP has been expired'));
        } if ($otp->type != $request->action) {
            return errorResponse(__('Invalid action'));
        }

        $otp->delete();
        $token = Hash::make($request->email);
        return successResponse(__('OTP verified successfully'), ['token' => $token]);


    }

}
