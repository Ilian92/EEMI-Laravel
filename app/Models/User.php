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
        'username',
        'password',
        'bio',
        'profile_picture',
        'banner_image',
        'subscription_price',
        'is_creator',
        'creator_since',
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
            'creator_since' => 'datetime',
            'subscription_price' => 'decimal:2',
            'is_creator' => 'boolean',
        ];
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'subscriber_id');
    }

    public function subscribers()
    {
        return $this->hasMany(Subscription::class, 'creator_id');
    }

    public function isSubscribedTo(User $creator)
    {
        return $this->subscriptions()
            ->where('creator_id', $creator->id)
            ->where('is_active', true)
            ->where('expires_at', '>', now())
            ->exists();
    }

    public function getProfilePictureUrlAttribute()
    {
        return $this->profile_picture ? asset('storage/' . $this->profile_picture) : asset('images/default-avatar.jpg');
    }

    public function getBannerImageUrlAttribute()
    {
        return $this->banner_image ? asset('storage/' . $this->banner_image) : asset('images/default-banner.jpg');
    }
}
