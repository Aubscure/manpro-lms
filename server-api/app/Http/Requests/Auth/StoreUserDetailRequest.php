<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\UserDetail;

class StoreUserDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            // No firstname/lastname here. We already have them!
            'middlename'   => ['nullable', 'string', 'max:255'],
            'suffix'       => ['nullable', 'string', 'max:10'],
            'birthdate'    => ['required', 'date'],
            'gender'       => ['required', 'in:male,female,non-binary'],
            'phone_number' => ['required', 'string', 'max:20'], // Adjust max as needed
            'address'      => ['required', 'string', 'max:500'],
        ];
    }
}
