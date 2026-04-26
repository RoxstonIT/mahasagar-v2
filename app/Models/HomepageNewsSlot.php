<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageNewsSlot extends Model
{
    public const FEATURED = 'featured';

    public const BREAKING_SLOTS = [
        'breaking_1',
        'breaking_2',
        'breaking_3',
    ];

    public const SLOTS = [
        self::FEATURED,
        'breaking_1',
        'breaking_2',
        'breaking_3',
    ];

    protected $fillable = [
        'slot',
        'article_id',
        'selected_by',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function selector()
    {
        return $this->belongsTo(User::class, 'selected_by');
    }
}
