<?php

namespace App\Contracts;

use App\Models\People\People;
use Illuminate\Database\Eloquent\Model;

interface PeopleContract
{
    public function create(array $data): People;

    public function find(int|string $id): People|null;

    public function update(array $where, array $data): People;

    public function destroy(int|string $id): bool;

    public function firstOrCreate(
        array $data,
        array $attributes = [],
    ): People;

    public function setModel(People $people): void;
}
