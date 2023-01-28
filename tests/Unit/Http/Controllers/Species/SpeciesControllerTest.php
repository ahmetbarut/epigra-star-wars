<?php

namespace Tests\Unit\Http\Controllers\Species;

use App\Models\Species\Species;
use App\Models\User;
use Tests\TestCase;

class SpeciesControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     * @group species
     */
    public function testGetAllRecords()
    {
        Species::factory()->count(10)->create();
        $user = $this->createUser();

        $response = $this->actingAs($user)->get('/api/species');
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
                        'classification',
                        'designation',
                        'average_height',
                        'skin_colors',
                        'hair_colors',
                        'eye_colors',
                        'average_lifespan',
                        'language',
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
        $species = Species::factory()->create();

        $this->actingAs($user)
            ->get('/api/species/' . $species->id)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' =>
                [
                    'id',
                    'name',
                    'classification',
                    'designation',
                    'average_height',
                    'skin_colors',
                    'hair_colors',
                    'eye_colors',
                    'average_lifespan',
                    'language',
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
