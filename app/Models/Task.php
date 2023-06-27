<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'task',
        'completed',
        'deadline'
    ];

    protected $attributes = [
        'completed' => 0
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
