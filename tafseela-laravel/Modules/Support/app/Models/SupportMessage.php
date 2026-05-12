<?php

namespace Modules\Support\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Traits\HasAuditions;
use Modules\Identity\Models\User;

class SupportMessage extends Model
{
    use HasAuditions;

    protected $fillable = [
        'support_ticket_id',
        'sender_id',
        'sender_type',
        'message',
        'is_internal',
        'read_at',
    ];

    protected function casts(): array
    {
        return [
            'is_internal' => 'boolean',
            'read_at' => 'datetime',
        ];
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(SupportTicket::class, 'support_ticket_id');
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
