<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    public function generate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'type' => 'required|in:registration,login',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $otpCode = rand(100000, 999999);

        $otp = Otp::create([
            'user_id' => $user->id,
            'otp_code' => $otpCode,
            'type' => $request->type,
            'expired_at' => now()->addMinute(5),
            'is_used' => false
        ]);

        // Mail::raw(
        //     "Hello! Your registration OTP code is: $otpCode. It expires in 5 minutes.",
        //     function ($message) use ($user) {
        //         $message->to($user->email)
        //             ->subject('Your Registration OTP');
        //     }
        // );
        Mail::raw(
            "Your OTP code is: $otpCode. Expires in 5 minutes.",
            function ($message) use ($user, $request) {
                $subject = $request->type === 'registration' ? 'Registration OTP' : 'Login OTP';
                $message->to($user->email)->subject($subject);
            }
        );

        return response()->json(['message' => 'OTP sent successfully']);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp_code' => 'required|digits:6',
            'type' => 'required|in:registration,login'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $otp = Otp::where('user_id', $user->id)
            ->where('otp_code', $request->otp_code)
            ->where('type', $request->type)
            ->where('is_used', false)
            ->where('expired_at', '>=', now())
            ->first();

        if (!$otp) {
            return response()->json(['message' => 'Invalid or expired OTP'], 400);
        }

        $otp->update(['is_used' => true]);

        if ($request->type === 'registration') {
            $user->update(['email_verified_at'=>now()]);
            return response()->json([
                'message' => 'Email verified successfully. Please login.'
            ]);
        }

        if ($request->type === 'login') {
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'message' => 'Login OTP verified successfully',
                'token' => $token,
                'user' => $user,
            ]);
        }

        return response()->json(['message' => 'Invalid OTP type'], 400);
    }
}
