<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Mail\RegisterMail;
use Illuminate\Http\JsonResponse;
use App\Models\Api\OtpValidation;
use App\Http\Requests\DriverRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    //
    public function index(DriverRequest $request): JsonResponse
    {

        try {
            $name = $request->input('name');
            $email = $request->input('email');
            $password = $request->input('password');
            $type = $request->input('type');
            $gender = $request->input('gender');

            $token = $request->header('token');
            $phone = $this->getPhoneNumber( $token );

            // save to user database
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'mobile' => $phone,
                'type' => $type,
                'gender' => $gender,
            ]);

            // send email when registration.
            $mailData = [
                'user_name' => $email,
                'name' => $name,
                'password' => $password,
            ];
            $isMailSend = Mail::to($email)->send(new RegisterMail($mailData));

            OtpValidation::where('token', $token)->delete();

            return response()->json([
                'success'   => true,
                'message'   => 'Account created successfully',
                'isMailSend' => $isMailSend,
            ]);

        }catch (\Exception $e) {
            return response()->json([
             'success' => false,
             'message' => $e->getMessage()
            ]);
        }

    }

    /**
     * Get phone number from token.
     * @param $token
     * @return mixed
     */
    private function getPhoneNumber( $token) {
        $otpRow = OtpValidation::where('token', $token)->first();
        return $otpRow->phone_number;
    }
}
