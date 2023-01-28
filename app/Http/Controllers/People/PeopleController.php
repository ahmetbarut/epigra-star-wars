<?php

namespace App\Http\Controllers\People;

use App\Contracts\PeopleContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\People\PeopleResource;
use App\Models\People\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function __construct(protected PeopleContract $peopleRepository)
    {
    }

    public function index()
    {
        return PeopleResource::collection($this->peopleRepository->all());
    }

    public function show(int $people)
    {
        return new PeopleResource($this->peopleRepository->find($people));
    }
}
