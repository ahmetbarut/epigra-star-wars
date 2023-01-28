<?php

namespace App\Models\People;

use App\Models\Vehicle\Vehicle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birth_year',
        'height',
        'mass',
        'hair_color',
        'skin_color',
        'eye_color',
        'gender',
        'homeworld',
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
