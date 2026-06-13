<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'activation_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'activation_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    public function roleLabel()
    {
        if ($this->role === 'client') {
            return 'Klient';
        } elseif ($this->role === 'kierownik') {
            return 'Kierownik';
        } elseif ($this->role === 'administrator') {
            return 'Administrator';
        } else {
            return $this->role;
        }
    }

    public function isAdmin(): bool
    {
        return $this->role === 'administrator';
    }

    public function isKierownik(): bool
    {
        return $this->role === 'kierownik';
    }

    public function isClient(): bool
    {
        return $this->role === 'client';
    }

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
