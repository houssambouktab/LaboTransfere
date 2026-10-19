<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
