<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workout extends Model
{
    /** @use HasFactory<\Database\Factories\WorkoutFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'scheduled_date',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class);
    }
}
