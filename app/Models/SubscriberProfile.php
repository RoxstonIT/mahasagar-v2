<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriberProfile extends Model
{
    protected $fillable = [
        'user_id',
        'profile_photo',
        'phone',
        'date_of_birth',
        'gender',
        'city',
        'state',
        'bio',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
