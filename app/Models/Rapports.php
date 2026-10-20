<?php

namespace App\Models;

use App\Models\Doctors;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;

class Rapports extends Model
{
    protected $table = 'rapports';

    protected $fillable = [
        'title',
        'patient_id',
        'doctor_id',
        'file_path',
        'uploaded_by',
        
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctors::class);
    }
}
