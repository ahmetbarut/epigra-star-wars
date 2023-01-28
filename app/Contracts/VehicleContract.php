<?php

namespace App\Contracts;

use App\Models\Vehicle\Vehicle;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface VehicleContract
{
    public function create(array $data): Vehicle;

    public function find(int|string $id): Vehicle|null;

    public function update(array $where, array $data): Vehicle;

    public function destroy(int|string $id): bool;

    public function all(): Collection;

    public function firstOrCreate(
        array $data,
        array $attributes = [],
    ): Vehicle;

    public function setModel(Vehicle $people): void;
}
