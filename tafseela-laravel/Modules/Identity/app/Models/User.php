<?php

namespace Modules\Identity\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

// use Modules\Identity\Database\Factories\UserFactory;

use Modules\Identity\Models\Profile;
use Modules\Identity\Models\UserLocation;
use Modules\Order\Models\Order;
use Modules\Cart\Models\UserCart;
use Modules\Delivery\Models\DeliveryAgent;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends \App\Models\User
{
    use Notifiable, HasRoles, HasApiTokens, LogsActivity;

    /**
     * The attributes that are mass-assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
        'avatar',
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function locations(): HasMany
    {
        return $this->hasMany(UserLocation::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function cart(): HasOne
    {
        return $this->hasOne(UserCart::class);
    }

    public function deliveryAgent(): HasOne
    {
        return $this->hasOne(DeliveryAgent::class);
    }

    public function getFullName(): string
    {
        return (string) $this->name;
    }

    public function hasVerifiedEmail(): bool
    {
        return ! is_null($this->email_verified_at);
    }

    public function markEmailAsVerified(): bool
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}

