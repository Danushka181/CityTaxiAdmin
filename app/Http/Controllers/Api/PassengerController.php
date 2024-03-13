<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Models\Passengers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class PassengerController extends Controller
{
    public function passengerRegister(Request $request, string $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.Passengers::class,
            'phone' => 'required|numeric|digits:10|unique:'.Passengers::class,
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        }

        $passenger = Passengers::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($passenger));

        // send email when registration.
        $mailData = [
            'user_name' => $request->email,
            'name' => $request->name,
            'password' => $request->password,
        ];
        Mail::to($request->email)->send(new RegisterMail($mailData));

        return response()->json(['success' => true, 'message' => 'Passenger Registered Successfully'], 200);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function passengerLogin(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric|digits:10',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        }

        $credentials = request(['phone', 'password']);

        if ($token = auth('passengers')->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['errors' => 'Invalid Login Details Please check!'], 403);
    }


    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me()
    {
        return response()->json(auth('passengers')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth('passengers')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth('passengers')->refresh());
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
            'expires_in' => auth('passengers')->factory()->getTTL() * 60,
            'user' => auth('passengers')->user()
        ]);
    }

}
