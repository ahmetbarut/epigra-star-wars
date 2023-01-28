<?php

namespace App\Repositories\Species;

use App\Contracts\SpeciesContract;
use App\Models\Species\Species;
use Illuminate\Database\Eloquent\Collection;

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

    public function update(array $where, array $data): Species
    {
        $this->species->where($where)->update($data);
        return $this->species->refresh();
    }

    public function destroy(int|string $id): bool
    {
        return $this->species->delete();
    }

    public function firstOrCreate(
        array $data,
        array $attributes = [],
    ): Species {
        return $this->species->firstOrCreate($data, $attributes);
    }

    public function setModel(Species $species): void
    {
        $this->species = $species;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->species->all($columns);
    }
}
