<?php

namespace App\Models;

use App\Models\Rapports;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    protected $fillable = [
        'user_id',
        'date_of_birth',
        'phone',
        'address',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rapports(): HasMany
    {
        return $this->hasMany(Rapports::class);
    }
}
