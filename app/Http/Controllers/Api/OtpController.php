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
                'phone_number' => 'required|numeric',
            ]);

            // check if Phonenumber already in the table
            $checkNumber = OtpValidation::where('phone_number', $request->phone_number)->where('state', 1)->first();
            if ( $checkNumber ) {
                return response()->json([
                    'success' => false,
                    'errors' => ['phone' => ['Phone number already exists!']]
                ], 403);
            }

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()->toArray(),
                ], 403);

            }

            $otp = rand(1000, 9999);
            $token = Str::uuid()->toString();

            $phoneNumber = $request->phone_number;

            // Send the OTP to the user via SMS (you'll need to implement this)
            $smsController = new SmsController();
            $message = 'City taxi Service OTP code is "' .$otp.'"';
//            $test = $smsController->sendSMS($phoneNumber, $message);
            $test = 1;

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
                        'otp' => $otp // for checking purpose
                    ]
                ]);
            }else {
                return response()->json([
                    'success' => false,
                    'errors' => ['phone' => ['Number is not working!']],
                ], 403);
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
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()->toArray(),
                ], 403);
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
                        'errors' => ['otp'=> ['OTP is expired!']]
                    ],403);
                }
            }else {

                return response()->json([
                    'success' => false,
                    'errors' => ['otp' => ['Invalid OTP code! Please check again.']],
                ], 403);
            }
        } catch ( Exception $e) {
            return response()->json([
              'success' => false,
              'message' => [$e->getMessage()]
            ], 500);
        }
    }

    // Resend OTP
    public function resendOTP(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make(
                [
                    'token' => 'uuid|required',
                ],
                ['token.uuid' => 'Something went wrong please try again']
            );

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()->toArray(),
                ], 403);

            }

            $otpTokenData = OtpValidation::where('token', $request->input('token'))->first();
            if ( $otpTokenData ) {
                $otp = rand(1000, 9999);
                $phoneNumber = $otpTokenData->phone_number;
                $message = 'City taxi Service OTP code is "' .$otp.'"';
                $smsController = new SmsController();
                $sendSms= $smsController->sendSMS($phoneNumber, $message);

                if ( $sendSms ) {
                    $otpTokenData->otp = $otp;
                    $otpTokenData->expire = Carbon::now()->addMinutes(5);
                    $otpTokenData->state = false;
                    $otpTokenData->save();

                    return response()->json([
                        'success' => true,
                        'message' => ['OTP code has been sent to your phone number'],
                        'data' => ['token' => $otpTokenData->token,'otp' => $otp]
                    ]);
                }else {
                    return response()->json([
                        'success' => false,
                        'errors' => ['phone' => ['Phone is not working']],
                    ], 403);
                }
            }else {
                return response()->json([
                    'success' => false,
                    'errors' => ['otp' => ['Invalid OTP code! Please check again.']],
                ], 403);
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
