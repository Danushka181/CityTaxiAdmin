<?php

namespace App\Http\Middleware;

use App\Models\Api\OtpValidation;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OtpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->headers->get('token');

        if (!$token) {
            return response()->json([
                'success' => false,
                'errors' => ['token' => ['Token not provided']]
            ], 403);
        }

        $OtpRow = OtpValidation::where('token', $token)->first();
        if (!$OtpRow) {
            return response()->json([
                'success' => false,
                'errors' => ['token' => ['Invalid token']]
            ], 403);
        }

        if (!$OtpRow->state) {
            return response()->json([
                'success' => false,
                'errors' => ['token' => ['OTP is not verified']]
            ], 403);
        }

        return $next($request);
    }
}
