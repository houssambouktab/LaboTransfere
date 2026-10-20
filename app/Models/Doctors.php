<?php

namespace App\Models;

use App\Models\Rapports;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctors extends Model
{
    protected $table = 'doctors';

    protected $fillable = [
        'user_id',
        'specialty',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rapports(): HasMany
    {
        return $this->hasMany(Rapports::class);
    }
}
