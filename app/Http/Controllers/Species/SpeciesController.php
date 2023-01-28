<?php

namespace App\Http\Controllers\Species;

use App\Contracts\SpeciesContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\Species\SpeciesResource;
use App\Models\Species;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    public function __construct(protected SpeciesContract $speciesRepository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SpeciesResource::collection($this->speciesRepository->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $species
     * @return \Illuminate\Http\Response
     */
    public function show($species)
    {
        return new SpeciesResource($this->speciesRepository->find($species));
    }
}
