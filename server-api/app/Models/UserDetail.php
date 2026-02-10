<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    // This explicitly links to your 'user_details' table
    protected $table = 'user_details';

    protected $fillable = [
        'user_id', // Important for linking
        'middlename',
        'suffix',
        'birthdate',
        'gender',
        'phone_number',
        'address',
    ];

    // Link back to the User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
