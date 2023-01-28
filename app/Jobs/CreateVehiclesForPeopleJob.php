<?php

namespace App\Jobs;

use App\Models\People\People;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class CreateVehiclesForPeopleJob implements ShouldQueue
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
        protected string $vehicle,
        protected People $people,
    ) {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $vehicle = Http::get($this->vehicle)
            ->throw(
                fn ($response) => new \Exception($response->body())
            )
            ->object();
        $this->people->vehicles()->firstOrCreate([
            'name' => $vehicle->name,
            'model' => $vehicle->model,
            'manufacturer' => $vehicle->manufacturer,
            'cost_in_credits' => $vehicle->cost_in_credits,
            'length' => $vehicle->length,
            'max_atmosphering_speed' => $vehicle->max_atmosphering_speed,
            'crew' => $vehicle->crew,
            'passengers' => $vehicle->passengers,
            'cargo_capacity' => $vehicle->cargo_capacity,
            'consumables' => $vehicle->consumables,
            'vehicle_class' => $vehicle->vehicle_class,
            'url' => $vehicle->url,
        ]);
    }
}
