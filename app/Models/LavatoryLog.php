<?php

namespace App\Models;

use Database\Factories\LavatoryLogFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LavatoryLog extends Model
{
    /** @use HasFactory<LavatoryLogFactory> */
    use HasFactory;

    protected $fillable = [
        'lavatory_id',
        'user_id',
        'status',
        'wait_time_minutes',
    ];

    /**
     * Get the bathroom
     */
    public function lavatory(): BelongsTo
    {
        return $this->belongsTo(Lavatory::class);
    }

    /**
     * Get the user associated with the log
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
