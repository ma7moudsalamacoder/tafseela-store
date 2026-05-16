<?php

namespace Modules\Identity\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Cart\Models\UserCart;
// use Modules\Identity\Database\Factories\UserFactory;

use Modules\Delivery\Models\DeliveryAgent;
use Modules\Order\Models\Order;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends \App\Models\User
{
    use HasApiTokens, HasRoles, LogsActivity, Notifiable;

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
