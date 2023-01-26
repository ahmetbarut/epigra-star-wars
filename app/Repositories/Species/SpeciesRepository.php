<?php

namespace App\Repositories\Species;

use App\Contracts\SpeciesContract;
use App\Models\Species\Species;

class SpeciesRepository implements SpeciesContract
{
    public function __construct(protected Species $species)
    {
    }

    public function create(array $data): Species
    {
        return $this->species->create($data);
    }

    public function find(int|string $id): Species|null
    {
        return Species::find($id);
    }

    public function update(array $data): Species
    {
        $this->species->update($data);
        return $this->species->refresh();
    }

    public function destroy(int|string $id): Species
    {
        return $this->species;
    }

    public function firstOrCreate(
        array $data,
        array $attributes = [],
    ): Species {
        return $this->species->firstOrCreate($data, $attributes);
    }
}
