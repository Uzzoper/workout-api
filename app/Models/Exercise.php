<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exercise extends Model
{
    /** @use HasFactory<\Database\Factories\ExerciseFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'sets',
        'reps',
        'weight',
        'position',
        'rest_time',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'weight' => 'decimal:2',
        ];
    }

    public function workout(): BelongsTo
    {
        return $this->belongsTo(Workout::class);
    }
}
