<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        if (!$user->email_verified_at) {
            return response()->json([
                'message' => 'Email not verified. Please complete registration OTP first.'
            ], 403);
        }

        // Credentials valid & email verified, frontend should now generate login OTP
        return response()->json([
            'message' => 'Login credentials valid. Please verify OTP.',
            'email' => $user->email
        ]);
    }
}
