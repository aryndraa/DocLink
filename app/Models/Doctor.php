<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'number',
        'specialist_id',
        'working_days',
    ];

    public function specialist() 
    {
        return $this->belongsTo(Specialist::class, 'specialist_id');
    }

    public function schedules() 
    {
        return $this->hasMany(Schedule::class, 'doctor_id');
    }
}
