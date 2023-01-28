<?php

namespace App\Http\Controllers\Vehicle;

use App\Contracts\VehicleContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\Vehicle\VehicleResource;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function __construct(protected VehicleContract $vehicleRepository)
    {
    }

    public function index()
    {
        return VehicleResource::collection($this->vehicleRepository->all());
    }

    public function show($id)
    {
        return new VehicleResource($this->vehicleRepository->find($id));
    }
}
