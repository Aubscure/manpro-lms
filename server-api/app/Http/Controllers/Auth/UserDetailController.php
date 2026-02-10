<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\StoreUserDetailRequest;
use App\Models\UserDetail;

class UserDetailController extends Controller
{

    public function store(StoreUserDetailRequest $request)
    {
        $user = $request->user();

        // Create or update the user details
        $user->details()->updateOrCreate(
            ['user_id' => $user->id], // Match by user_id
            $request->validated() // Use validated data from the request
        );

        return response()->json(['message' => 'User details saved successfully.']);
    }

    public function show(Request $request)
    {
        $user = $request->user()->load('details'); // Eager load details to avoid N+1 problem

        return response()->json([
            'firstname' => $user->firstname,
            'lastname'  => $user->lastname,
            'details'   => $user->details,
        ]);
    }
}
