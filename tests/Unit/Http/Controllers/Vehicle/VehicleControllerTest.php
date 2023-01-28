<?php

namespace Tests\Unit\Http\Controllers\Vehicle;

use App\Models\People\People;
use App\Models\Vehicle\Vehicle;
use App\Models\User;
use Tests\TestCase;

class VehicleControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     * @group species
     */
    public function testGetAllRecords()
    {
        $people = People::factory()->create();
        Vehicle::factory()->count(10)->create([
            'people_id' => $people->id
        ]);
        $user = $this->createUser();

        $response = $this->actingAs($user)->get('/api/vehicles');
        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');

        $response->assertJsonStructure(
            [
                'data' =>
                [
                    '*' =>
                    [
                        'id',
                        'name',
                        'model',
                        'manufacturer',
                        'cost_in_credits',
                        'length',
                        'max_atmosphering_speed',
                        'crew',
                        'passengers',
                        'cargo_capacity',
                        'consumables',
                        'vehicle_class',
                        'url',
                        'people_id',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]
        );
    }

    /**
     * A basic unit test example.
     *
     * @return void
     * @group species
     */
    public function testGetRecord()
    {
        $user = $this->createUser();

        $people = People::factory()->create();
        $vehicle = Vehicle::factory()->create(['people_id' => $people->id]);

        $this->actingAs($user)
            ->get('/api/vehicles/' . $vehicle->id)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' =>
                [
                    'id',
                    'name',
                    'model',
                    'manufacturer',
                    'cost_in_credits',
                    'length',
                    'max_atmosphering_speed',
                    'crew',
                    'passengers',
                    'cargo_capacity',
                    'consumables',
                    'vehicle_class',
                    'url',
                    'people_id',
                    'created_at',
                    'updated_at',
                ]
            ]);
    }

    /**
     * @return User
     */
    public function createUser(): User
    {
        return User::factory()->create();
    }
}
