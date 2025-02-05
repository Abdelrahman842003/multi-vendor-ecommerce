<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'street_address',
        'city',
        'postal_code',
        'address',
        'phone',
        'photo',
        'country',
        'locale',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}

