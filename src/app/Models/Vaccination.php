<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vaccination extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'pet_id',
        'serial_number',
        'vaccinated_at',
        'valid_days',
        'country'
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}

