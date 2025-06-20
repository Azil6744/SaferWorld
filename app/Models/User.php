<?php

namespace App\Models;

use App\Models\Purchase;
use App\Traits\HasTrial;
use Spatie\Sluggable\HasSlug;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Notifications\Notifiable;
use App\Notifications\EmailVerifyNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasSlug, HasApiTokens, HasTrial;

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
        'email_verified_at',
        'last_login',
        'has_had_trial',
        'apple_id',
        'banned_at',
        'google_id',
        'ban_reason',
        'slug',
        'registration_date',
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
            'last_login' => 'datetime',
            'registration_date' => 'datetime',
            'banned_at' => 'datetime',
            'has_had_trial' => 'boolean',
            'apple_id' => 'string',
            'google_id' => 'string',
            'ban_reason' => 'string',
        ];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new EmailVerifyNotification);
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    public function activePlan()
    {
        return $this->hasOne(Purchase::class)->where('status', 'active')->where('end_date', '>', now())->latest();
    }

    public function isBanned(): bool
    {
        return !is_null($this->banned_at);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function hasAnyRole(string ...$roles): bool
    {
        return in_array($this->role, $roles);
    }
}
