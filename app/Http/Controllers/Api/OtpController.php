<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SmsController;
use App\Models\Api\OtpValidation;
use App\Models\User;
use Exception;
use Faker\Core\Uuid;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OtpController extends Controller
{

    // login with OTP number
    public function loginWithOTP(Request $request): JsonResponse
    {
        try {
            // Validate request data
            $validator = Validator::make($request->all(), [
                'phone_number' => 'required|numeric|unique:otp_validations',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 403);
            }

            $otp = rand(1000, 9999);
            $token = Str::uuid()->toString();

            $phoneNumber = $request->phone_number;

            // Send the OTP to the user via SMS (you'll need to implement this)
            $smsController = new SmsController();
            $message = 'City taxi Service OTP code is "' .$otp.'"';
            $test = $smsController->sendSMS($phoneNumber, $message);

            if ( $test ) {
                OtpValidation::create([
                    'phone_number' => $phoneNumber,
                    'otp' => $otp,
                    'expire' => Carbon::now()->addMinutes(5),
                    'state' => false,
                    'token' => $token,
                ]);

                return response()->json([
                    'success' => true,
                    'title' => 'Please enter your OTP number',
                    'data' => [
                        'token' => $token,
                        'otp' => $otp
                    ]
                ]);
            }else {
                return response()->json(['errors' => 'Phone is not working'], 403);
            }

        }catch (Exception $e){
            return response()->json([
             'success' => false,
             'message' => [$e->getMessage()]
            ], 500);
        }
    }

    // OTP Verifications
    public function verifyWithOTP(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'token' => 'uuid|required',
                    'otp' => 'required|numeric|digits:4',
                ],
                ['token.uuid' => 'Something went wrong please try again']
            );

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 403);
            }

            $otpTokenData = $this->checkToken( $request->input('token'), $request->input('otp') );
            if ( $otpTokenData ) {
                $isExpired = $this->expiredOtpCheck( $otpTokenData->expire);
                if ( !$isExpired ) {
                    $otpRow = OtpValidation::where('token', $otpTokenData->token)->first();
                    $otpRow->state = true;
                    $otpRow->save();

                    return response()->json([
                        'success' => true,
                        'message' => ['OTP verification successful'],
                        'token' => $otpTokenData->token,
                        'data' => ['phone_number' => $otpTokenData->phone_number]
                    ]);
                }else {
                    return response()->json([
                        'success' => false,
                        'errors' => ['OTP is expired!']
                    ],400);
                }
            }else {
                return response()->json([
                    'errors' => 'Invalid OTP code! Please check again.',
                ], 400);
            }
        } catch ( Exception $e) {
            return response()->json([
              'success' => false,
              'message' => [$e->getMessage()]
            ], 500);
        }
    }

    // check OTP is valid.
    protected function checkToken($token, $otp) {
        return OtpValidation::where('token', $token)
            ->where('otp', $otp)
            ->first();
    }

    // check OTP is expired.
    protected function expiredOtpCheck( $expireTime ): bool
    {
        return Carbon::now()->gt($expireTime);
    }

}
