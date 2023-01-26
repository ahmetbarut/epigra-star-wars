<?php

namespace App\Repositories\People;

use App\Contracts\PeopleContract;
use App\Models\People\People;

class PeopleRepository implements PeopleContract
{
    public function __construct(protected People $people)
    {
    }

    public function create(array $data): People
    {
        return $this->people->create($data);
    }

    public function find(int|string $id): People|null
    {
        return $this->people->find($id);
    }

    public function update(array $where, array $data): People
    {
        $this->people->where($where)->update($data);
        return $this->people->refresh();
    }

    public function destroy(int|string $id): bool
    {
        return $this->people->delete();
    }

    public function firstOrCreate(
        array $data,
        array $attributes = [],
    ): People {
        return $this->people->firstOrCreate($data, $attributes);
    }

    public function setModel(People $people): void
    {
        $this->people = $people;
    }
}
