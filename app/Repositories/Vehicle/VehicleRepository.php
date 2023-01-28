<?php

namespace App\Repositories\Vehicle;

use App\Contracts\VehicleContract;
use App\Models\Vehicle\Vehicle;
use Illuminate\Database\Eloquent\Collection;

class VehicleRepository implements VehicleContract
{
    public function __construct(protected Vehicle $vehicle)
    {
    }

    public function create(array $data): Vehicle
    {
        return $this->vehicle->create($data);
    }

    public function find(int|string $id): Vehicle|null
    {
        return $this->vehicle->find($id);
    }

    public function update(array $where, array $data): Vehicle
    {
        $this->vehicle->where($where)->update($data);
        return $this->vehicle->refresh();
    }

    public function destroy(int|string $id): bool
    {
        return $this->vehicle->delete();
    }

    public function firstOrCreate(
        array $data,
        array $attributes = [],
    ): Vehicle {
        return $this->vehicle->firstOrCreate($data, $attributes);
    }

    public function setModel(Vehicle $vehicle): void
    {
        $this->vehicle = $vehicle;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->vehicle->all($columns);
    }
}
