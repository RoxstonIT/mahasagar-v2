<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'verification_token',
        'verified_at',
        'source',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isVerified()
    {
        return !is_null($this->verified_at);
    }
}
