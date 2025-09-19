<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

