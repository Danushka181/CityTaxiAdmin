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
                'error' => ['Token not provided']
            ], 405);
        }

        $OtpRow = OtpValidation::where('token', $token)->first();
        if (!$OtpRow) {
            return response()->json([
                'success' => false,
                'error' => ['Invalid token']
            ], 405);
        }

        if (!$OtpRow->state) {
            return response()->json([
                'success' => false,
                'error' => ['OTP is not verified']
            ], 405);
        }

        return $next($request);
    }
}
