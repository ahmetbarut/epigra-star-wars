<?php

namespace App\Models\People;

use App\Models\Species\Species;
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

    protected $appends = [
        'species'
    ];

    protected $with = [
        'vehicles',
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function getSpeciesAttribute()
    {
        return $this->belongsToMany(Species::class, 'species_peoples', 'species_id', 'people_id')
            ->first()
            ?->withoutRelations();
    }
}
