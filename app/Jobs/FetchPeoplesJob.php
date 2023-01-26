<?php

namespace App\Jobs;

use App\Contracts\PeopleContract;
use App\Contracts\SpeciesContract;
use App\Models\Species\Species;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class FetchPeoplesJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        protected string $people,
        protected Species $species,
        protected PeopleContract $peopleRepository,
    ) {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Http::get($this->people)
            ->throw()
            ->object();

        $people = $this->peopleRepository->firstOrCreate([
            'name' => $response->name,
            'birth_year' => $response->birth_year,
            'height' => $response->height,
            'mass' => $response->mass,
            'hair_color' => $response->hair_color,
            'skin_color' => $response->skin_color,
            'eye_color' => $response->eye_color,
            'gender' => $response->gender,
            'homeworld' => $response->homeworld,
        ]);

        $this->species->peoples()->attach($people->id);
    }
}
