<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class);
    }

    public function savedArticleRecords()
    {
        return $this->hasMany(SavedArticle::class);
    }

    public function savedArticles()
    {
        return $this->belongsToMany(Article::class, 'saved_articles')
            ->withTimestamps();
    }

    public function likedArticleRecords()
    {
        return $this->hasMany(ArticleLike::class);
    }

    public function likedArticles()
    {
        return $this->belongsToMany(Article::class, 'article_likes')
            ->withTimestamps();
    }

    public function articleComments()
    {
        return $this->hasMany(ArticleComment::class);
    }

    public function hasRole($roleName)
    {
        return $this->roles()
            ->where('name', $roleName)
            ->exists();
    }
    
    public function hasPermission($permissionName)
    {
        return $this->roles()
            ->whereHas('permissions', function ($q) use ($permissionName) {
                $q->where('name', $permissionName);
            })
            ->exists();
    }
    
}
