<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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
        'role',
        'is_active',
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
            'is_active' => 'boolean',
        ];
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->getAttribute('role') === 'admin';
    }

    /**
     * Check if user is regular user
     */
    public function isUser(): bool
    {
        return $this->getAttribute('role') === 'user';
    }

    /**
     * Check if user has role
     */
    public function hasRole(string $role): bool
    {
        return $this->getAttribute('role') === $role;
    }

    /**
     * Relasi dengan Cart
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Relasi dengan Order
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Scope untuk user aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Cart relationship
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Orders relationship
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
