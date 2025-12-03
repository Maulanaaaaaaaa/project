<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',

        // Social login
        'google_id',
        'facebook_id',
        'github_id', // <-- tambahkan


        // Avatar terpisah
        'google_avatar',
        'facebook_avatar',
        'github_avatar', // <-- tambahkan


        'avatar_local_path',

        // Tambahkan kolom baru
        'last_login_provider',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Types for casts.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Accessor: avatar gabungan google / facebook / default.
     * Avatar akan disesuaikan dengan provider login terakhir.
     */
    public function getAvatarAttribute()
    {
        if ($this->last_login_provider === 'google' && !empty($this->google_avatar)) {
            return $this->google_avatar;
        }

        if ($this->last_login_provider === 'facebook' && !empty($this->facebook_avatar)) {
            return $this->facebook_avatar;
        }

        if ($this->last_login_provider === 'github' && !empty($this->github_avatar)) {
            return $this->github_avatar;
        }

        // Fallback jika provider tidak diketahui
        if (!empty($this->google_avatar)) {
            return $this->google_avatar;
        }

        if (!empty($this->facebook_avatar)) {
            return $this->facebook_avatar;
        }

        if (!empty($this->github_avatar)) {
            return $this->github_avatar;
        }

        // Default avatar
        return asset('images/images1.png');
    }
}
