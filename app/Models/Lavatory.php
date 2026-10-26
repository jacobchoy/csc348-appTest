<?php

namespace App\Models;

use Database\Factories\LavatoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lavatory extends Model
{
    /** @use HasFactory<LavatoryFactory> */
    use HasFactory;

    protected $fillable = [
        'location',
        'status',
        'gender_type',
    ];

    /**
     * Get the lavatory's status logs
     */
    public function lavatoryLogs(): HasMany
    {
        return $this->hasMany(LavatoryLog::class);
    }
}
