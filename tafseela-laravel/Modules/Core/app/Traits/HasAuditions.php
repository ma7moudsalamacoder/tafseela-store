<?php

namespace Modules\Core\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Identity\Models\User;

trait HasAuditions
{
    public function created_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function updated_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

    public function deleted_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by_id');
    }

    protected static function bootHasAuditions(): void
    {
        static::creating(function ($model): void {
            $model->created_by_id = auth()->id();
            $model->updated_by_id = auth()->id();
        });

        static::updating(function ($model): void {
            $model->updated_by_id = auth()->id();
        });

        static::deleting(function ($model): void {
            $model->deleted_by_id = auth()->id();
        });
    }
}

