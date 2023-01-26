<?php

namespace App\Contracts;

use App\Models\Species\Species;

interface SpeciesContract
{
    public function create(array $data): Species;

    public function find(int|string $id): Species|null;

    public function update(array $where, array $data): Species;

    public function destroy(int|string $id): bool;

    public function firstOrCreate(
        array $data,
        array $attributes = [],
    ): Species;

    public function setModel(Species $species): void;
}
