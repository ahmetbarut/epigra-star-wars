<?php

namespace Tests\Feature\Repositories;

use App\Contracts\VehicleContract;
use App\Models\People\People;
use App\Models\Species\Species;
use App\Models\Vehicle\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VehicleRepositoryTest extends TestCase
{
    /** @var VehicleContract $vehicleRepository */
    protected $vehicleRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->vehicleRepository = $this->app->make(VehicleContract::class);
    }

    public function testCreate()
    {
        $people = People::factory()->create();
        $vehicle = 'Test vehicle';
        $vehicleModel = $this->vehicleRepository->create([
            'name' => $vehicle,
            'model' => "Flitknot speeder",
            'manufacturer' => "Huppla Pasa Tisc Shipwrights Collective",
            'cost_in_credits' => "8000",
            'length' => "2",
            'max_atmosphering_speed' => "634",
            'crew' => "1",
            'passengers' => "0",
            'cargo_capacity' => "unknown",
            'consumables' => "unknown",
            'vehicle_class' => "speeder",
            'url' => "https://swapi.dev/api/vehicles/55/",
            'people_id' => $people->id,
        ]);

        $this->assertInstanceOf(Vehicle::class, $vehicleModel);

        $this->assertEquals($vehicle, $vehicleModel->name);

        $this->assertDatabaseHas('vehicles', [
            'name' => $vehicle,
        ]);

        $this->assertDatabaseCount('vehicles', 1);
    }

    public function testFind()
    {
        $people = People::factory()->create();
        $vehicle = 'Test vehicle';
        $vehicleModel = $this->vehicleRepository->create([
            'name' => $vehicle,
            'model' => "Flitknot speeder",
            'manufacturer' => "Huppla Pasa Tisc Shipwrights Collective",
            'cost_in_credits' => "8000",
            'length' => "2",
            'max_atmosphering_speed' => "634",
            'crew' => "1",
            'passengers' => "0",
            'cargo_capacity' => "unknown",
            'consumables' => "unknown",
            'vehicle_class' => "speeder",
            'url' => "https://swapi.dev/api/vehicles/55/",
            'people_id' => $people->id,
        ]);
        $vehicleModel = $this->vehicleRepository->find($vehicleModel->id);
        $this->assertInstanceOf(Vehicle::class, $vehicleModel);
    }

    public function testUpdate()
    {
        $people = People::factory()->create();
        $vehicle = 'Test vehicle';
        $vehicleModel = $this->vehicleRepository->create([
            'name' => $vehicle,
            'model' => "Flitknot speeder",
            'manufacturer' => "Huppla Pasa Tisc Shipwrights Collective",
            'cost_in_credits' => "8000",
            'length' => "2",
            'max_atmosphering_speed' => "634",
            'crew' => "1",
            'passengers' => "0",
            'cargo_capacity' => "unknown",
            'consumables' => "unknown",
            'vehicle_class' => "speeder",
            'url' => "https://swapi.dev/api/vehicles/55/",
            'people_id' => $people->id,
        ]);
        $this->vehicleRepository->setModel($vehicleModel);

        $newName = 'Jedi Test';

        $vehicleModel = $this->vehicleRepository->update(
            [
                'id' => $vehicleModel->id,
            ],
            [
                'name' => $newName,
            ]
        );

        $this->assertInstanceOf(Vehicle::class, $vehicleModel);

        $this->assertEquals($newName, $vehicleModel->name);
    }

    public function testDestroy()
    {
        $people = People::factory()->create();
        $vehicle = 'Test vehicle';
        $vehicleModel = $this->vehicleRepository->create([
            'id' => 1,
            'name' => $vehicle,
            'model' => "Flitknot speeder",
            'manufacturer' => "Huppla Pasa Tisc Shipwrights Collective",
            'cost_in_credits' => "8000",
            'length' => "2",
            'max_atmosphering_speed' => "634",
            'crew' => "1",
            'passengers' => "0",
            'cargo_capacity' => "unknown",
            'consumables' => "unknown",
            'vehicle_class' => "speeder",
            'url' => "https://swapi.dev/api/vehicles/55/",
            'people_id' => $people->id,
        ]);

        $this->vehicleRepository->setModel($vehicleModel);

        $vehicleModel = $this->vehicleRepository->destroy($vehicleModel->id);

        $this->assertTrue($vehicleModel);

        $this->assertDatabaseMissing('species', [
            'name' => $vehicle,
        ]);
    }
}
