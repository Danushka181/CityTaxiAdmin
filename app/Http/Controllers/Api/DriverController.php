<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Models\Drivers;
use App\Models\Passengers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class DriverController extends Controller
{
    public function driverRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.Drivers::class,
            'phone' => 'required|numeric|unique:'.Drivers::class,
            'password' => ['required'],
            'address' => 'required|string|max:255',
            'identity_card' => 'required|string|max:255',
            'license_number' => 'required|string|max:18',
            'hire_rate' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->toArray(),
            ], 403);
        }



        $driver = Drivers::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'identity_card' => $request->identity_card,
            'license_number' => $request->license_number,
            'hire_rate' => $request->hire_rate
        ]);

        event(new Registered($driver));

        // send email when registration.
        $mailData = [
            'user_name' => $request->email,
            'name' => $request->name,
            'password' => $request->password,
        ];
        Mail::to($request->email)->send(new RegisterMail($mailData));

        return response()->json(['success' => true, 'message' => 'Driver Registered Successfully'], 200);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function driverLogin(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric|digits:10',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->toArray(),
            ], 403);
        }

        $credentials = request(['phone', 'password']);

        if ($token = auth('drivers')->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json([
            'success' => false,
            'errors' => ['login'=>['Invalid Login Details Please check!']],
        ], 403);
    }


    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me()
    {
        return response()->json(auth('drivers')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth('drivers')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth('drivers')->refresh());
    }

    /**
     * Get the token array structure.
     * @return JsonResponse
     */
    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('drivers')->factory()->getTTL() * 60,
            'user' => auth('drivers')->user()
        ]);
    }


}
