<?php

namespace App\Models\Species;

use App\Models\People\People;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'classification',
        'designation',
        'average_height',
        'skin_colors',
        'hair_colors',
        'eye_colors',
        'average_lifespan',
        'language',
    ];

    public function peoples()
    {
        return $this->belongsToMany(People::class, 'species_peoples', 'species_id', 'people_id');
    }
}
