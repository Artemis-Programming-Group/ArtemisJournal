<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'email_verified_at',
        'password',
        'avatar',
        'bio',
        'role',
        'is_active',
        'country',
        'city',
        'website',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return asset('upload/' . $this->avatar);
        }

        // Generate initials avatar
        $initials = collect(explode(' ', trim($this->name)))
            ->filter(fn($word) => mb_strlen($word, 'UTF-8') > 0) // remove empty parts
            ->map(fn($word) => mb_strtoupper(mb_substr($word, 0, 1, 'UTF-8'), 'UTF-8'))
            ->implode('');

        return "https://api.dicebear.com/7.x/initials/svg?seed={$initials}";
    }
}
